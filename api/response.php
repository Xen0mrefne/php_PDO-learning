<?php declare(strict_types = 1);

class Response {
    private int $status;
    private string $message;
    private string $error;
    
    function __construct(string $message = NULL, string $error = NULL) {
        $this->message = $message;
        $this->error = $error;
    }

    
    public function getStatus(): int{
        return $this->status;
    }

    public function setStatus(int $status): void {
        $this->status = $status;
    }

    public function getMessage(): string {
        return $this->message;
    }
    
    public function setMessage(string $message): void {
        $this->message = $message;
    }

    public function getError(): string {
        return $this->error;
    }

    public function setError(string $error): void {
        $this->error = $error;
    }

}

?>