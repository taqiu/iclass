import sys
import MySQLdb
import time
import string
from optparse import OptionParser


insert_T_L = """INSERT INTO dev_image_data (uploader, flickr_user, date_uploaded_flickr, latitude, longitude, dev_image_data.precision, title, license, flickr_photo_id, date_uploaded, farm, server, secret) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)""";
insert_T = """INSERT INTO dev_image_data (uploader, flickr_user, date_uploaded_flickr, latitude, longitude, dev_image_data.precision, title, flickr_photo_id, date_uploaded, farm, server, secret) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)""";
insert_L = """INSERT INTO dev_image_data (uploader, flickr_user, date_uploaded_flickr, latitude, longitude, dev_image_data.precision, license, flickr_photo_id, date_uploaded, farm, server, secret) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)""";
insert = """INSERT INTO dev_image_data (uploader, flickr_user, date_uploaded_flickr, latitude, longitude, dev_image_data.precision, flickr_photo_id, date_uploaded, farm, server, secret) VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)""";
tag_insert = """INSERT INTO dev_tag (image_id, tag_text) VALUES (%s,%s)""";

parser = OptionParser("usage: %prog [options] filename")
parser.add_option("-o","--offset",dest = "offset", help="Line offset of where to begin parsing the file. Default is beginning.")
parser.add_option("-l","--limit",dest = "limit", help="Index of the last line to be read from the file. Default is end.")

(options, args) = parser.parse_args();


if len(args) != 1:
	print "Must specify one and only 1 input file!"
	parser.print_help();
	sys.exit();

filename = args[0];

#Open connection
conn = MySQLdb.connect(host= "localhost",
                  user="cvision",
                  passwd="Computer vision is hard",
                  db="ICLASS")



x = conn.cursor()

#Open file
try:
	input_file = open(filename, 'r');
except IOError, er:
	print er
	sys.exit();

line_num = 0;
#Skip to offset
if options.offset != None:
	options.offset = float(options.offset);
	for i in range(0, int(options.offset)):
		line = input_file.readline();
		line_num = line_num + 1;		
		if line == "":
			print "Offset greater than size of file."
			sys.exit();
else:
	options.offset = 0;

while True:
	#Check limit
	if options.limit != None and line_num >= float(options.limit):		
		print "Added " + str(line_num-options.offset) + " records.";
		break;

	if line_num % 10000 == 0:
		print line_num

	#Parse line
	line = input_file.readline();
	if line == "":
		print "Added " + str(line_num-options.offset) + " records.";
		break;
	line_num = line_num + 1;
	line_split = line.split();
	temp = line_split[0].split("@N")
	flickr_user = temp[0]+temp[1];
	flickr_photo_id = line_split[1];
	date_uploaded_flickr = line_split[7];
	date_uploaded = time.strftime("%Y-%m-%d %H:%M:%S");
	latitude = line_split[9];
	longitude = line_split[10];
	precision = line_split[11];
	secret = line_split[12];
	server = line_split[13];
	farm = line_split[14];
	uploader = 1;

	temp = line_split[17].split('=');
	if len(temp) > 1:
		title = filter(lambda x: x in string.printable, temp[1]);
	else:
		title = None;
	
	temp = line_split[18].split('=');
	if len(temp) > 1 and temp[1]!="":
		license = temp[1];
	else:
		license = None;	
	
		
	#Insert image record
	try:
		if title != None and license != None:
			x.execute(insert_T_L, 
					(uploader, flickr_user, date_uploaded_flickr, latitude, longitude, precision, 
					title, license, flickr_photo_id, date_uploaded, farm, server, secret))
		elif title != None:
			x.execute(insert_T,
					(uploader, flickr_user, date_uploaded_flickr, latitude, longitude, precision, 
					title, flickr_photo_id, date_uploaded, farm, server, secret))
		elif license != None: 
			x.execute(insert_L,
					(uploader, flickr_user, date_uploaded_flickr, latitude, longitude, precision, 
					license, flickr_photo_id, date_uploaded, farm, server, secret))
		else: 
			x.execute(insert,
					(uploader, flickr_user, date_uploaded_flickr, latitude, longitude, precision, 
					flickr_photo_id, date_uploaded, farm, server, secret))
		conn.commit()
	   
		image_id = x.lastrowid;

    	#Insert tags
		if len(line_split) >= 21:
			tags = line_split[20].split(',');
			for tag_text in tags:
				try:
					x.execute(tag_insert,(image_id, filter(lambda x: x in string.printable, tag_text)))
					conn.commit()
				except MySQLdb.Error, er:
					print er
					conn.rollback()
	except MySQLdb.Error,er:
		print er
	   	conn.rollback()
	

#Close connection
conn.close()
input_file.close()
