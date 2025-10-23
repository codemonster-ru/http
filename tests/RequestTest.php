<?php

use Codemonster\Http\Request;
use PHPUnit\Framework\TestCase;

class RequestTest extends TestCase
{
    public function testManualInstantiation(): void
    {
        $request = new Request('POST', '/api/test', ['page' => '1'], ['name' => 'Vasya'], ['Accept' => 'application/json']);

        $this->assertSame('POST', $request->method());
        $this->assertSame('/api/test', $request->uri());
        $this->assertSame('1', $request->query('page'));
        $this->assertSame('Vasya', $request->input('name'));
        $this->assertTrue($request->wantsJson());
    }

    public function testCaptureFromGlobals(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/hello';
        $_SERVER['HTTP_ACCEPT'] = 'text/html';
        $_GET = ['id' => '42'];
        $_POST = [];

        $request = Request::capture();

        $this->assertSame('GET', $request->method());
        $this->assertSame('/hello', $request->uri());
        $this->assertSame('42', $request->query('id'));
        $this->assertFalse($request->wantsJson());
    }

    public function testJsonBodyParsing(): void
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/api';
        $_SERVER['HTTP_CONTENT_TYPE'] = 'application/json';
        $json = json_encode(['foo' => 'bar']);

        file_put_contents('php://memory', $json);

        $request = new Request('POST', '/api', [], ['foo' => 'bar'], ['Content-Type' => 'application/json'], $json);

        $this->assertSame('bar', $request->input('foo'));
        $this->assertSame('/api', $request->uri());
    }

    public function testFullUrlComposition(): void
    {
        $request = new Request('GET', '/user', [], [], [], '', ['HTTP_HOST' => 'example.com', 'HTTPS' => 'on']);

        $this->assertSame('https://example.com/user', $request->fullUrl());
    }
}
