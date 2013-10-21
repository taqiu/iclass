Image Collaborative Labeling and Semantic Search (ICLASS)
===============
![alt text](http://vision.soic.indiana.edu/wp/wp-content/themes/responsive/core/images/default-logo.png "IU computer vision lab")

### Project Statement ###
Our project seeks to build a prototype database application that improves the organization and usability of this image data collection, using the PHP and MySQL environment provided by the course. We would like to provide users the capability to add new image data to the dataset, modify image data in the dataset, search based on metadata and labelings, download selected images, create new labelings, and label existing images. As we are likely constrained by our shared development environment, we intend to utilize only a subset of the lab’s data (somewhere around 100,000 to 200,000 images). This framework would allow for collaborative labelling of images. The scale of this problem present some inherent technical difficulties, specifically searching the records over many fields. We will have to choose our storage and search approaches carefully to reduce the latency of these transactions. If after optimization the delay seems long (on the scale of half a second or more), we will need to provide some feedback to the user as discussed in class.

### Core Functinality ###
* Secure user accounts to access the data.
* New images and corresponding metadata can be added.
* Images can be searched based on any of the metadata fields or labelings.
* Images can be downloaded in batch or one at a time based on search selection.
* Labelings can be created, modified, or deleted. When a labelling is created the name, a semantic description, and the set of possible responses must be specified. Additionally, which users have access to provide answers to the given label will also be set.
* For each labeling, unlabeled images can be presented to users for labeling. Both the selected label and the user should be recorded.

### References ###
- [B561 web page](http://www.cs.indiana.edu/~yuqwu/courses/B561-fall13/webpage/)
- [B561 2012fall PHP and MySQL Setup](http://www.cs.indiana.edu/~yuqwu/courses/B561-fall13/webpage/phpmysql.html)
- [IU computer vision lab](http://vision.soic.indiana.edu/)
- [IU SOIC](http://www.soic.indiana.edu/)
