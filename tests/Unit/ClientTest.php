<?php

namespace Tests\Unit;

use App\Config\Config;
use App\Helpers\Profiler;
use App\Jwt\Jwt;
use App\Services\Client\Client;
use App\Services\Client\ResultFormatter;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client as GuzzleClient;
use Psr\Http\Message\ResponseInterface;

class ClientTest extends TestCase
{
    public function testRun(): void {
        $fakeToken = 'Fake Token Lol :D';
        $fakeExecutionTime = 42.42;
        $fakeOutput = 'Lorem ipsum';

        $jwtMock = $this->createMock(Jwt::class);
        $jwtMock->expects($this->once())
            ->method('generateJwt')
            ->willReturn($fakeToken);

        $responseStub = $this->createStub(ResponseInterface::class);

        $guzzleMock = $this->createMock(GuzzleClient::class);
        $guzzleMock->expects($this->once())
            ->method('get')
            ->with('http://server/v1/foo', [
                'headers' => [
                    'Authorization' => $fakeToken
                ]
            ])
            ->willReturn($responseStub);

        $configStub = $this->createStub(Config::class);

        $profilerMock = $this->createMock(Profiler::class);
        $profilerMock->expects($this->once())
            ->method('getExecutionTime')
            ->willReturnCallback(
                function (callable $cb) use ($fakeExecutionTime) {
                    $cb();

                    return $fakeExecutionTime;
                }
            );

        $resultFormatterMock = $this->createMock(ResultFormatter::class);
        $resultFormatterMock->expects($this->once())
            ->method('format')
            ->with($fakeExecutionTime)
            ->willReturn($fakeOutput);

        ob_start();
        $client = new Client(
            guzzleClient: $guzzleMock,
            resultFormatter: $resultFormatterMock,
            config: $configStub,
            jwt: $jwtMock,
            profiler: $profilerMock,
        );
        $client->run();
        $output = ob_get_contents();

        $this->assertEquals($fakeOutput, $output);
    }
}