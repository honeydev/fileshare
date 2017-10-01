<?php
/** add validators */

$container['SessionModelValidator'] = function () {
	return new Fileshare\Validators\SessionModelValidator();
};
