<?php

namespace App;
use Model;
use NasExt\Forms\Controls\Range;
use NasExt\Forms\Controls\RangeSlider;
use Nette;


/**
 * Homepage presenter.
 */
class HomepagePresenter extends BasePresenter
{


	public function renderDefault()
	{

	}

	/**
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentRangeSliderForm()
	{
		$form = new Nette\Application\UI\Form();
		$form->getElementPrototype()->novalidate = 'novalidate';

		$range = new Range(10, 100);
		$form->addRangeslider('rangeSlider', 'Set range', $range)
			->setAttribute('data-custom-init', Nette\Utils\Json::encode(array('step'=>2)))
			->setDefaultValue(new Range(15, 66))
			->addRule($form::FILLED, 'Please complete mandatory field')
			->addRule(RangeSlider::INTEGER, 'Please enter a numeric value')
			->addRule(RangeSlider::RANGE, 'Please enter a value between %d and %d', $range->getRange());

		$form->addSubmit('send');
		$form->onSuccess[] = callback($this, 'formSubmitted');
		return $form;
	}

	/**
	 * @param Nette\Application\UI\Form $form
	 */
	public function formSubmitted(Nette\Application\UI\Form $form)
	{
		$this->template->rangeSliderValues = $form->getValues();
	}

}
