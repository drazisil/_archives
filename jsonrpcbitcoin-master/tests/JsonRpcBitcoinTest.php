<?php
require_once(__DIR__ . '/../src/JsonRpcBitcoin/JsonRpcBitcoin.php');
use \JsonRpcBitcoin\JsonRpcBitcoin;

require_once('config.php');

$blockhash;

class JsonRpcBitcoinTest extends PHPUnit_Framework_TestCase
{
	public function setUp(){
		global $configRpcUser, $configRpcPass, $configRpcHost, $configRpcPort;
		
		$this->bitcoindConn = new JsonRpcBitcoin($configRpcUser, $configRpcPass, $configRpcHost, $configRpcPort);
		$this->blockHash = '';
	}
	public function tearDown(){ }

	public function testCanConnectToBitcoind()
	{	
		global $configRpcUser, $configRpcPass, $configRpcHost, $configRpcPort;
		
		$connObj = new JsonRpcBitcoin($configRpcUser, $configRpcPass, $configRpcHost, $configRpcPort);
		$result = (array)json_decode($connObj->sendRaw('getinfo'));
		$this->assertNotNull($result['result']);
	}

	/**
	* @depends testCanConnectToBitcoind
	*/
	public function testCanAuthenticateToBitcoindWithBadCred()
	{	
		global $configRpcHost, $configRpcPort;
		
		$connObj = new JsonRpcBitcoin('xxx', 'xxx', $configRpcHost, $configRpcPort);
		$this->assertJsonStringEqualsJsonString(
			$connObj->sendRaw('getinfo'), 
			json_encode(array(
				'result' => null, 
				'error' => array(
					'code' => 401, 
					'message' => 'Unable to authenticate to bitcoind'
				),
				'id' => 'jsonrpcbitcoin'
			))
		);
	}

	/**
	* @depends testCanConnectToBitcoind
	*/
	public function testCanAuthenticateToBitcoindWithGoodCred()
	{	
		global $configRpcUser, $configRpcPass, $configRpcHost, $configRpcPort;
		
		$connObj = new JsonRpcBitcoin($configRpcUser, $configRpcPass, $configRpcHost, $configRpcPort);
		$result = (array)json_decode($connObj->sendRaw('getinfo'));
		$this->assertNotNull($result['result']);
	}

	/**
	* @depends testCanAuthenticateToBitcoindWithGoodCred
	*/
	public function testCanSendWithBadParams()
	{	
		global $configRpcUser, $configRpcPass, $configRpcHost, $configRpcPort;
		
		$connObj = new JsonRpcBitcoin($configRpcUser, $configRpcPass, $configRpcHost, $configRpcPort);
		$result = (array)json_decode($connObj->sendRaw('getblockhash', array('NotABlockHeight')));
		$this->assertNotNull($result['error']);
	}

	/**
	* @depends testCanAuthenticateToBitcoindWithGoodCred
	*/
	public function testCanSendWithGoodParams()
	{	
		global $configRpcUser, $configRpcPass, $configRpcHost, $configRpcPort;
		
		$connObj = new JsonRpcBitcoin($configRpcUser, $configRpcPass, $configRpcHost, $configRpcPort);
		$result = (array)json_decode($connObj->sendRaw('getblockhash', array(5)));
		$this->assertNotNull($result['result']);
	}
	
	/**
	* @depends testCanAuthenticateToBitcoindWithGoodCred
	*/
	public function testIsOnRegTest() {
		$result = (array)json_decode($this->bitcoindConn->getblockhash(0));
		$this->assertNotEquals($result['result'], '000000000019d6689c085ae165831e934ff763ae46a2a6c172b3f1b60a8ce26f');

	}

    /**
	* Nondistructive Chain tests
	*/

	/**
	* @depends testCanAuthenticateToBitcoindWithGoodCred
	*/
	public function testCmdChainGetInfo()
	{	
		$result = (array)json_decode($this->bitcoindConn->getinfo());
		$this->assertNotNull($result['result']);
	}
	
	/**
	* @depends testCanAuthenticateToBitcoindWithGoodCred
	*/
	public function testCmdGetBlockHash()
	{	
		$result = (array)json_decode($this->bitcoindConn->getblockhash(0));
		$this->assertNotNull($result['result']);
		return $result['result']; // the block hash
	}

	/**
	* @depends testCanAuthenticateToBitcoindWithGoodCred
	*/
	public function testCmdGetBlockCount()
	{	
		$result = (array)json_decode($this->bitcoindConn->getblockcount());
		$this->assertInternalType('integer', $result['result']);
	}

/**
	* @depends testCmdGetBlockHash
	*/
	public function testCmdGetBlock($blockHash)
	{	
		$result = (array)json_decode($this->bitcoindConn->getblock($blockHash));
		$this->assertNotNull($result['result']);
	}

	/**
	* @depends testCmdGetBlockHash
	*/
	public function testCmdGetBlockTx($blockHash)
	{	
		$result = (array)json_decode($this->bitcoindConn->getblock($blockHash));
		$this->assertNotNull($result['result']);
        return $result['result']->tx;
	}

    /**
	* @depends testCmdGetBlockTx
	*/
	public function testCmdGetRawTransaction($tx)
	{	
		$result = (array)json_decode($this->bitcoindConn->getrawtransaction($tx[0], 1));
		$this->assertEquals((string)$result['result']->txid, '4a5e1e4baab89f3a32518a88c31bc87f618f76673e2cc77ab2127b7afdeda33b');
        return (string)$result['result']->txid;
	}

    /**
	* @depends testCmdGetRawTransaction
	*/
	public function testCmdGetTxCoinbase($txId)
	{	
		$result = (array)json_decode($this->bitcoindConn->getrawtransaction($txId));
        $vin = (array)$result['result']->vin;
        $this->assertEquals((string)$vin[0]->coinbase, 
        '04ffff001d0104455468652054696d65732030332f4a616e2f32303039204368616e63656c6c6f72206f6e206272696e6b206f66207365636f6e64206261696c6f757420666f722062616e6b73');
	}

/**
	* Distructive Chain tests
	*/

	/**
	* @depends testIsOnRegTest
	*/
	public function testCmdChainAddNode()
	{	
		// Stop here and mark this test as incomplete.
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}

	/**
	* Nondistructive Wallet tests
	*/

	/**
	* @depends testCanAuthenticateToBitcoindWithGoodCred
	*/
	public function testCmdWalletGetBalance()
	{	
		// Stop here and mark this test as incomplete.
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}

	/**
	* Distructive Wallet tests
	*/

	/**
	* @depends testIsOnRegTest
	*/
	public function testCmdWalletAddMultiSigAddress()
	{	
		// Stop here and mark this test as incomplete.
		$this->markTestIncomplete(
			'This test has not been implemented yet.'
		);
	}
}
?>