<?php
$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h3>About</h3>
<hr/>

<h4> I. Motivation </h4>
<p style="text-align:justify">Large scale machine learning and data mining often require sifting through sizeable quantities of data to identify relevant records before any experimentation can be done. This preprocessing task can be exceedingly costly if the data is not well organized or easily accessible.  Our case study for this project is the IU <a href="http://vision.soic.indiana.edu/">Computer Vision Lab&#39;s</a> image data collection. The lab maintains a collection of millions of images and associated metadata downloaded from Flickr and uses these images in machine learning experiments. Often only a subset of the images have attributes appropriate  for a given experiment  &#40;i.e. are in the geographic region of interest or have a certain text tag&#41; and selecting these images from the whole collection is currently performed by utilizing specialized scripts  written on a case by case basis to navigate the file system. In many experiments, images need to be annotated with additional labels depending on the study. Two examples of such labelings are &#34;contains snow&#34; or &#34;is in a city&#34;. Streamlining these processes would allow for more agile experimentation.</p>
<h4> II. Project Statement </h4>
<p style="text-align:justify">Image Collaborative Labelling And Semantic Search System seeks to improves the organization and usability of the image data collection for the IU Computer Vision Lab. The lab maintains a collection of millions of images and associated metadata downloaded from Flickr and uses these images in machine learning experiments and data mining. This often require sifting through sizeable quantities of data to identify relevant records before any experimentation can be done. This preprocessing task can be exceedingly costly if the data is not well organized or easily accessible.</p>
<p style="text-align:justify">The application allows user to upload the image data in database having various attributes appropriate for a given experiment (i.e. are in the geographic region of interest or have a certain text tag). Thus it  improves the organization and usability of this image data collection by providing capability to the users to add new image data to the dataset, modify image data in the dataset, search based on metadata and labelings, download selected images, create new labelings, and label existing images. This framework also allows for collaborative labeling of images.</p>
<h4> III. Development Team Members</h4>
<ul>
	<li> <b>Stefan Lee</b> - steflee@indiana.edu</li>
	<li> <b>Rosy Agarwal</b> - rosyagar@indiana.edu</li>
	<li> <b>Nikita Pandey</b> - npandey@indiana.edu</li>
	<li> <b>Tanghong Qiu</b> - taqiu@indiana.edu</li>
</ul>
