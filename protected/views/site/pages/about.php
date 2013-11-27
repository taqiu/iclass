<?php
$this->pageTitle=Yii::app()->name . ' - About';
$this->breadcrumbs=array(
	'About',
);
?>
<h3>About</h3>
<hr/>

<h4> I. Motivation </h4>
<p>Large scale machine learning and data mining often require sifting through sizeable quantities of data to identify relevant records before any experimentation can be done. This preprocessing task can be exceedingly costly if the data is not well organized or easily accessible.  Our case study for this project is the IU <a href="http://vision.soic.indiana.edu/">Computer Vision Lab&#39;s</a> image data collection. The lab maintains a collection of millions of images and associated metadata downloaded from Flickr and uses these images in machine learning experiments. Often only a subset of the images have attributes appropriate  for a given experiment  &#40;i.e. are in the geographic region of interest or have a certain text tag&#41; and selecting these images from the whole collection is currently performed by utilizing specialized scripts  written on a case by case basis to navigate the file system. In many experiments, images need to be annotated with additional labels depending on the study. Two examples of such labelings are &#34;contains snow&#34; or &#34;is in a city&#34;. Streamlining these processes would allow for more agile experimentation.</p>
<h4> II. Project Statement </h4>
<p>Our project seeks to build a prototype database application that improves the organization and usability of this image data collection.We would like to provide users the capability to add new image data to the dataset, modify image data in the dataset, search based on metadata and labelings, download selected images, create new labelings, and label existing images. As we are likely constrained by our shared development environment, we intend to utilize only a subset of the lab&#39;s data (somewhere around 100,000 to 200,000 images). This framework would allow for collaborative labeling of images. The scale of this problem present some inherent technical difficulties, specifically searching the records over many fields. We will have to choose our storage and search approaches carefully to reduce the latency of these transactions.</p> 
<h5> Core Functionality </h5>
<ul>
<li>Secure user accounts to access the data.</li>
<li>New image metadata can be added.</li>
<li>Image data can be searched based on any of the metadata fields or labelings.</li>
<li>Image data can be downloaded in batch or one at a time based on search selection.</li>
<li>Labelings can be created, modified, or deleted.  When a labelling is created the name, a semantic description, and the set of possible responses must be specified. </li>
<li>For each labeling, unlabeled images can be presented to users for labeling. Both the selected label and the user should be recorded. </li>
</ul>