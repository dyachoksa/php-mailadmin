<?php

class BaseController extends Controller {

    public function __construct() {
        $this->beforeFilter(function() {
            if (Request::isMethod('get') && Input::has('lang')) {
                $lang = Input::get('lang', 'en');

                $lang = strtolower(substr($lang, 0, 2));

                Session::set('lang', $lang);
                App::setLocale($lang);
            }
        });
    }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout() {
		if (!is_null($this->layout)) {
			$this->layout = View::make($this->layout);
		}
	}

}
