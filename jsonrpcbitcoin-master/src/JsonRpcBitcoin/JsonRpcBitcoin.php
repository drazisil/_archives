<?php
namespace JsonRpcBitcoin;

class JsonRpcBitcoin {
	protected $rpcUser;
	protected $rpcPass;
	protected $rpcHost;
	protected $rpcPort;
	
	public $result;
	
	public function __construct($user, $pass, $host, $port) {

		if (is_string($user)) {
			$this->rpcUser = $user;
		} 
		else {
			return $this->build_json_error(0, 'Unable to connect to bitcoind: username is not a string');
		}	

		if (is_string($pass)) {
			$this->rpcPass = $pass;
		} 
		else {
			return $this->build_json_error(0, 'Unable to connect to bitcoind: password is not a string');
		}	

		if (!empty($host) && is_string($host)) {
			$this->rpcHost = $host;
		} 
		else {
			return $this->build_json_error(0, 'Unable to connect to bitcoind: host is not a string');
		}	

		if (!empty($port) && is_numeric($port)) {
			$this->rpcPort = $port;
		} 
		else {
			return $this->build_json_error(0, 'Unable to connect to bitcoind: port not numeric');
		}	
	}
	
	public function getbalance() {
		return $this->build_json_error(0, 'Not yet supported');
	}

	public function getblock($blockhash) {
		return $this->sendRaw('getblock', array($blockhash));
	}

	public function getblockcount() {
		return $this->sendRaw('getblockcount', array());
	}

	public function getblockhash($blockheight) {
		return $this->sendRaw('getblockhash', array($blockheight));
	}

	public function getinfo() {
		return $this->sendRaw('getinfo');
	}
	
	public function getrawtransaction($blockhash, $verbose=0) {
        if ($blockhash == '4a5e1e4baab89f3a32518a88c31bc87f618f76673e2cc77ab2127b7afdeda33b') {
            // This is the genesis transaction. It does not exist and can not be queried
            return '{"result" : {"txid" : "4a5e1e4baab89f3a32518a88c31bc87f618f76673e2cc77ab2127b7afdeda33b",
                        "version" : 1,
                        "locktime" : 0,
                        "vin" : [
                        {
                            "coinbase" : "04ffff001d0104455468652054696d65732030332f4a616e2f32303039204368616e63656c6c6f72206f6e206272696e6b206f66207365636f6e64206261696c6f757420666f722062616e6b73",
                            "sequence" : 4294967295
                        }
                        ],
                        "vout" : [
                        {
                            "value" : 50.00000000,
                            "n" : 0,
                            "scriptPubKey" : {
                                "asm" : "04678afdb0fe5548271967f1a67130b7105cd6a828e03909a67962e0ea1f61deb649f6bc3f4cef38c4f35504e51ec112de5c384df7ba0b8d578a4c702b6bf11d5f OP_CHECKSIG",
                                "hex" : "4104678afdb0fe5548271967f1a67130b7105cd6a828e03909a67962e0ea1f61deb649f6bc3f4cef38c4f35504e51ec112de5c384df7ba0b8d578a4c702b6bf11d5fac",
                                "reqSigs" : 1,
                                "type" : "pubkey",
                                "addresses" : [
                                    "1A1zP1eP5QGefi2DMPTfTL5SLmv7DivfNa"
                                ]
                            }
                        }
                        ]
            }}';
        }
        else {
            return $this->sendRaw('getrawtransaction', array($blockhash, $verbose));
        }
	}

	public function sendRaw($method, $params = array()) {
		return $this->send($method, $params);
	}

	private function send($method, $params = array()){
		/* method and params were passed */
		if (func_num_args() == 2){
			$postdata = array(
				'method' => func_get_arg(0),
				'params' => func_get_arg(1),
				'id' => 1
			);
		}
		/* only method was passed */
		else if (func_num_args() == 1){
			$postdata = array(
				'method' => func_get_arg(0),
				'params' => array(),
				'id' => 1
			);
		} 
		/* either too many of not enough arguments were passed, error */
		else {
			return $this->build_json_error(0, 'Invalid number of arguments passed to send');
		}

		$postdata_json = json_encode($postdata);
		
		$bitcoinAuth = base64_encode($this->rpcUser . ':' . $this->rpcPass);
		
		$request_headers = array();
		$request_headers[] = 'Authorization: Basic '. $bitcoinAuth;
		$request_headers[] = 'Content-type: application/json';
	
		//open connection
		$ch = curl_init();
	
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, 'http://' . $this->rpcHost . ':' . $this->rpcPort);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $request_headers);
		curl_setopt($ch, CURLOPT_POST, count($postdata));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata_json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		//execute post
		$result = curl_exec($ch);
		
		if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 401) {
			return $this->build_json_error(401, 'Unable to authenticate to bitcoind');
		}
		
		if (curl_getinfo($ch, CURLINFO_HTTP_CODE) != 200) {
			return $this->build_json_error(curl_getinfo($ch, CURLINFO_HTTP_CODE), $result);
		}
		
		$this->result = $result;

		//close connection
		curl_close($ch);
	
		return $result;
	}
	
	private function build_json_error($code, $message) {
		$result = json_encode(array(
			'result' => null, 
			'error' => array(
				'code' => $code, 
				'message' => $message
			),
			'id' => 'jsonrpcbitcoin'
		));
		return $result;
	}
}
?>
