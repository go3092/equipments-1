<?php

function not_found()
{
    $pagecontent = view('errors.404');

	//masterpage
    $pagemain = array(
        'title' => 'Home',
        'menu' => 'dashboard',
        'submenu' => '',
        'pagecontent' => $pagecontent,
    );

    return view('masterpage', $pagemain);
}
