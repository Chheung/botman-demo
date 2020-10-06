<?php

namespace App\Exceptions;

use Exception;
use ReflectionException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Database\QueryException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\UnauthorizedException;
use Prettus\Validator\Exceptions\ValidatorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use App\Response\CustomRenderer;

class Handler extends ExceptionHandler
{
    use CustomRenderer;
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
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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

        if ($exception instanceof ModelNotFoundException) {
            $exception = new NotFoundHttpException($exception->getMessage(), $exception);
        }

        if ($exception instanceof NotFoundHttpException) {
            $message = $exception->getMessage();
            $this->setStatusCode(Response::HTTP_NOT_FOUND);

            return $this->baseErrorResponse($message);
        }

        if ($exception instanceof QueryException) {
            $message = $exception->getMessage();
            $this->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);

            return $this->baseErrorResponse($message);
        }

        if ($exception instanceof ValidatorException) {
            $message = trans('validation.invalid_data');
            $errors = $exception->getMessageBag();
            $this->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);

            return $this->baseErrorResponse($message, 'fail', $errors);
        }

        return parent::render($request, $exception);
    }
}
