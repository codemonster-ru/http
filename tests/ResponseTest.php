<?php

use Codemonster\Http\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function testDefaultResponse(): void
    {
        $response = new Response('Hello');

        $this->assertSame('Hello', $response->getContent());
        $this->assertSame(200, $response->getStatusCode());
        $this->assertSame([], $response->getHeaders());
    }

    public function testJsonResponse(): void
    {
        $response = Response::json(['ok' => true]);

        $this->assertTrue($response->isJson());
        $this->assertStringContainsString('"ok": true', $response->getContent());
        $this->assertSame(200, $response->getStatusCode());
    }

    public function testRedirectResponse(): void
    {
        $response = Response::redirect('/login');

        $this->assertSame(302, $response->getStatusCode());
        $this->assertTrue($response->hasHeader('Location'));
        $this->assertSame('/login', $response->getHeaders()['Location']);
    }

    public function testHeaderManipulation(): void
    {
        $response = new Response('Hello', 200);
        $response->header('X-Test', '1');

        $this->assertTrue($response->hasHeader('X-Test'));
        $this->assertSame('1', $response->getHeaders()['X-Test']);
    }

    public function testToStringCastsContent(): void
    {
        $response = new Response('OK');

        $this->assertSame('OK', (string)$response);
    }
}
