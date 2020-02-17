<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException as AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($this->isHttpException($exception)) {
          switch ($exception->getStatusCode()) {
            // not found
            case '404':
                return \Response::view('errors.404');
              break;

            //not authorize
            case '403':
            $pagecontent = view('errors.403');

              $pagemain = array(
                  'title' => 'Home',
                  'menu' => 'dashboard',
                  'submenu' => '',
                  'pagecontent' => $pagecontent,
              );
              return \Response::view('masterpage', $pagemain);
              break;

            default:
              return $this->renderHttpException($exception);
              break;
          }
        }else{

          return parent::render($request, $exception);
        }

        if ($exception instanceof AuthenticationException) {
          return redirect('/');
        }else{
          return parent::render($request, $exception);
        }
    }
}
