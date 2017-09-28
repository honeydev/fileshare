<?php
/** add validators */

$container['SessionModelValidator'] = function () {
	return new Fileshare\validators\SessionModelValidator();
};