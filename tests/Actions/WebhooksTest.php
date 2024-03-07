<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2\Tests\Actions;

use CdekSDK2\Actions\Webhooks;
use CdekSDK2\Constraints\PrintFormTypes;
use CdekSDK2\Dto\InputHook;
use CdekSDK2\BaseTypes\WebHook;
use CdekSDK2\Client;
use CdekSDK2\Constants;
use CdekSDK2\Http\ApiResponse;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpClient\Psr18Client;

class WebhooksTest extends TestCase
{
    /**
     * @var Webhooks
     */
    protected $webhooks;

    protected function setUp(): void
    {
        parent::setUp();
        $psr18Client = new Psr18Client(HttpClient::create([
            'verify_peer' => false,
            'verify_host' => false,
        ]));
        $client = new Client($psr18Client);
        $client->setTest(true);
        $this->webhooks = $client->webhooks();
        \Doctrine\Common\Annotations\AnnotationReader::addGlobalIgnoredName('phan');

        /** @phan-suppress-next-line PhanDeprecatedFunction */
        \Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->webhooks = null;
    }

    public function testParseHookOrderStatus()
    {
        $input_hook = '{
  "type": "ORDER_STATUS",
  "date_time": "2023-11-28T07:44:45+0000",
  "uuid": "72753031-1820-4f99-9240-aab139f05ca5",
  "attributes": {
    "is_return": false,
    "is_reverse": false,
    "is_client_return": false,
    "cdek_number": "1100285492",
    "number": "17011574744791",
    "related_entities": [],
    "code": "RECEIVED_AT_SHIPMENT_WAREHOUSE",
    "status_code": "3",
    "status_date_time": "2023-11-28T07:44:45+0000",
    "city_name": "Новосибирск",
    "city_code": "270"
  }
}';
        $hook = $this->webhooks->parse($input_hook);
        $this->assertInstanceOf(InputHook::class, $hook);
        $this->assertStringContainsString(Constants::HOOK_TYPE_STATUS, $hook->type);
        $this->assertEquals('2023-11-28T07:44:45+0000', $hook->date_time);
        $this->assertEquals('72753031-1820-4f99-9240-aab139f05ca5', $hook->uuid);
        $this->assertEquals(false, $hook->attributes->is_return);
        $this->assertEquals(false, $hook->attributes->is_reverse);
        $this->assertEquals(false, $hook->attributes->is_client_return);
        $this->assertEquals(1100285492, $hook->attributes->cdek_number);
        $this->assertEquals(17011574744791, $hook->attributes->number);
        $this->assertEquals('RECEIVED_AT_SHIPMENT_WAREHOUSE', $hook->attributes->code); //TODO: Упаковать в константы
        $this->assertEquals(3, $hook->attributes->status_code);
        $this->assertEquals('2023-11-28T07:44:45+0000', $hook->attributes->status_date_time);
        $this->assertEquals('Новосибирск', $hook->attributes->city_name);
        $this->assertEquals(270, $hook->attributes->city_code);
    }

    public function testParseHookPrintForm()
    {
        $input_hook = '{
  "type": "PRINT_FORM",
  "date_time": "2023-11-28T09:03:31+0000",
  "uuid": "72753031-e1f1-4fc8-97ee-d58a010b6a67",
  "attributes": {
    "type": "BARCODE",
    "url": "https://api.cdek.ru/v2/print/barcodes/72753031-e1f1-4fc8-97ee-d58a010b6a67.pdf"
  }
}';
        $hook = $this->webhooks->parse($input_hook);
        $this->assertInstanceOf(InputHook::class, $hook);
        $this->assertStringContainsString(Constants::HOOK_PRINT_STATUS, $hook->type);
        $this->assertEquals('2023-11-28T09:03:31+0000', $hook->date_time);
        $this->assertEquals('72753031-e1f1-4fc8-97ee-d58a010b6a67', $hook->uuid);
        $this->assertEquals(PrintFormTypes::BARCODE, $hook->attributes->type);
        $this->assertEquals(
            'https://api.cdek.ru/v2/print/barcodes/72753031-e1f1-4fc8-97ee-d58a010b6a67.pdf',
            $hook->attributes->url
        );
    }

    public function testParseHookDownloadPhoto()
    {
        $input_hook = '{
  "type": "DOWNLOAD_PHOTO",
  "date_time": "2023-11-29T05:00:01+0000",
  "uuid": "72753031-7288-4d57-a893-29451197aa01",
  "attributes": {
    "cdek_number": 1100239959,
    "link": "https://photo-docs.production.cdek.ru/archives/qWErtY"
  }
}';
        $hook = $this->webhooks->parse($input_hook);
        $this->assertInstanceOf(InputHook::class, $hook);
        $this->assertStringContainsString(Constants::HOOK_DOWNLOAD_PHOTO, $hook->type);
        $this->assertEquals('2023-11-29T05:00:01+0000', $hook->date_time);
        $this->assertEquals('72753031-7288-4d57-a893-29451197aa01', $hook->uuid);
        $this->assertEquals(1100239959, $hook->attributes->cdek_number);
        $this->assertEquals(
            'https://photo-docs.production.cdek.ru/archives/qWErtY',
            $hook->attributes->link
        );
    }

    public function testParseHookPrealertClosed()
    {
        $input_hook = '{
  "type": "PREALERT_CLOSED",
  "date_time": "2023-01-23T10:20:02+0000",
  "uuid": "72753031-a1d3-4266-bc9f-8052f0fc3b2c",
  "attributes": {
    "prealert_number": "PA/7/583",
    "closed_date": "2023-01-17T07:59:18+0000",
    "fact_shipment_point": "NSK1"
  }
}';
        $hook = $this->webhooks->parse($input_hook);
        $this->assertInstanceOf(InputHook::class, $hook);
        $this->assertStringContainsString(Constants::HOOK_PREALERT_CLOSED, $hook->type);
        $this->assertEquals('2023-01-23T10:20:02+0000', $hook->date_time);
        $this->assertEquals('72753031-a1d3-4266-bc9f-8052f0fc3b2c', $hook->uuid);
        $this->assertEquals('PA/7/583', $hook->attributes->prealert_number);
        $this->assertEquals('2023-01-17T07:59:18+0000', $hook->attributes->closed_date);
        $this->assertEquals('NSK1', $hook->attributes->fact_shipment_point);
    }

    public function testParseHookFailData()
    {
        $hook = $this->webhooks->parse('<xml/>');
        $this->assertNull($hook->type);
    }

    public function testAdd()
    {
        $response = $this->webhooks->add(new WebHook([]));
        $this->assertInstanceOf(ApiResponse::class, $response);
    }

    public function testDelete()
    {
        $response = $this->webhooks->delete('webhook');
        $this->assertInstanceOf(ApiResponse::class, $response);
    }

    public function testGet()
    {
        $response = $this->webhooks->get('webhook');
        $this->assertInstanceOf(ApiResponse::class, $response);
    }

    public function testList()
    {
        $response = $this->webhooks->list();
        $this->assertInstanceOf(ApiResponse::class, $response);
    }
}
