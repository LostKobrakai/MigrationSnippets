<?php

/**
 * Remove a template instead of adding it.
 * Does also work for other special migration types
 */
class Migration_0000_00_00_00_00 extends TemplateMigration {

	public static $description = "Remove template myTemplate";

	protected function getTemplateName(){ return 'myTemplate'; }

	protected function templateSetup(Template $t){}

	/**
	 * Reverse the functions to remove a template instead of adding it
	 */
	public function update ()
	{
		return parent::downgrade();
	}

	public function downgrade ()
	{
		parent::update();
	}


}
