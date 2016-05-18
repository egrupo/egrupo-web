<?php

function mySlug(){
	return Auth::user()->organization->slug;
}