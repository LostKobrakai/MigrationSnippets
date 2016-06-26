<?php

/**
 * Add a template as allowed child for home and it's own
 * home
 * ⌊ recursive
 *   ⌊ recursive
 *     ⌊ recursive
 */
class Migration_0000_00_00_00_00 extends Migration{

	public static $description = "Add recursive template as allowed child";

	public function update() {
		$newChild = $this->templates->get('recursive');
		$home = $this->templates->get('home');

		// add new child templates for home (keep previous)
		$home->childTemplates = array_merge(
			$home->childTemplates, 
			array($newChild->id)
		);
		$home->save();

		// Parent/Child template for the new template
		$newChild->parentTemplates = array($home->id, $newChild->id);
		$newChild->childTemplates = array($newChild->id);
		$newChild->save();
	}

	public function downgrade() {
		$newChild = $this->templates->get('recursive');
		$home = $this->templates->get('home');

		// Remove template from the array
		$templates = $home->childTemplates;
		$key = array_search($newChild->id, $templates);
		if($key !== false){
			unset($templates[$key]);
			$home->childTemplates = $templates;
			$home->save();
		}

		// Reset to no templates selected
		$newChild->parentTemplates = array();
		$newChild->childTemplates = array();
		$newChild->save();
	}
}