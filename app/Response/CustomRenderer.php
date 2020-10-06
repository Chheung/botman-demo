<?php

namespace App\Response;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as IlluminateResponse;
use Illuminate\Support\Facades\Log;

trait CustomRenderer {
  /**
   * Default status code
   */
  protected $statusCode = IlluminateResponse::HTTP_OK;

  public function getStatusCode()
  {
      return $this->statusCode;
  }

  public function setStatusCode($statusCode)
  {
      $this->statusCode = $statusCode;
  }

  public function respond($data)
  {
      return response()->json($data, $this->getStatusCode());
  }

  public function baseSuccessResponse($message, $status = 'success', $payload = [])
  {
      $data = array(
          'status' => $status,
          'message' => $message,
          'status_code' => $this->getStatusCode(),
      );
      if ($status === 'fail') {
          $data = array_merge(['errors' => $errors], $data);
      } else {
        $data['data'] = $payload;
      }
      return $this->respond($data);
  }

  public function createResponse($message = 'Item created', $payload = [])
  { 
        $status = 'success';
        $this->setStatusCode(IlluminateResponse::HTTP_CREATED);
        return $this->baseSuccessResponse($message, $status, $payload);
  }
  
  public function successResponse($message = 'Successfully retrieved', $payload = [])
  { 
        $status = 'success';
        $this->setStatusCode(IlluminateResponse::HTTP_OK);
        return $this->baseSuccessResponse($message, $status, $payload);
  }

  public function baseErrorResponse($message, $error = [])
  {
        $status = 'fail';
        $data = array(
            'status' => $status,
            'message' => $message,
            'status_code' => $this->getStatusCode(),
        );
        if (count($error)) {
            $data = array_merge(['errors' => $errors], $data);
        }
        return $this->respond($data);
  }
}
