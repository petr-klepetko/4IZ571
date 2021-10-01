<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;


final class DemoPresenter extends Nette\Application\UI\Presenter
{
	public function renderSoucet($cislo1, $cislo2) {
		$this->template->cislo1 = $cislo1;
		$this->template->cislo2 = $cislo2;
		$this->template->soucet = $cislo1 + $cislo2;
	}
}
