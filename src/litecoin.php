<?php

	namespace BlockSDK;
	
	class Litecoin extends Base{
		public function getBlockChain(){
			return $this->request("GET","/ltc/block");
		}		
		
		public function getBlock($request){
			$request['rawtx'] = isset($request['rawtx'])==false ?false:$request['rawtx'];
			
			$request['offset'] = isset($request['offset'])==false ?0:$request['offset'];
			$request['limit'] = isset($request['limit'])==false ?10:$request['limit'];
			
			return $this->request("GET","/ltc/block/{$request['block']}",[
				"rawtx" => $request['rawtx'],
				"offset" => $request['offset'],
				"limit" => $request['limit']
			]);
		}
		
		public function getAddressInfo($request){
			$request['reverse'] = isset($request['reverse'])==false ?true:$request['reverse'];
			$request['rawtx'] = isset($request['rawtx'])==false ?null:$request['rawtx'];
			
			$request['offset'] = isset($request['offset'])==false ?0:$request['offset'];
			$request['limit'] = isset($request['limit'])==false ?10:$request['limit'];
			
			return $this->request("GET","/ltc/address/{$request['address']}",[
				"reverse" => $request['reverse'],
				"rawtx" => $request['rawtx'],
				"offset" => $request['offset'],
				"limit" => $request['limit']
			]);
		}
		
		public function getAddressBalance($request){

			return $this->request("GET","/ltc/address/{$request['address']}/balance");
		}

		
		 
		public function listWallet($request = null){
			$request['offset'] = isset($request['offset'])==false ?0:$request['offset'];
			$request['limit'] = isset($request['limit'])==false ?10:$request['limit'];
			
			return $this->request("GET","/ltc/wallet",[
				"offset" => $request['offset'],
				"limit" => $request['limit']
			]);
		}
		
		public function createWallet($request = null){
			$request['name'] = isset($request['name'])==false ?null:$request['name'];
			
			return $this->request("POST","/ltc/wallet",[
				"name" => $request['name']
			]);
		}
		
		public function loadWallet($request){
			
			return $this->request("POST","/ltc/wallet/{$request['wallet_id']}/load",[
				"seed_wif" => $request['seed_wif']
			]);
		}
		
		public function unLoadWallet($request){
			
			return $this->request("POST","/ltc/wallet/{$request['wallet_id']}/unload");
		}
		
		public function listWalletAddress($request){
			$request['address'] = isset($request['address'])==false ?null:$request['address'];
			$request['hdkeypath'] = isset($request['hdkeypath'])==false ?null:$request['hdkeypath'];
			
			$request['offset'] = isset($request['offset'])==false ?0:$request['offset'];
			$request['limit'] = isset($request['limit'])==false ?10:$request['limit'];
			
			return $this->request("GET","/ltc/wallet/{$request['wallet_id']}/address",[
				"address" => $request['address'],
				"hdkeypath" => $request['hdkeypath'],
				"offset" => $request['offset'],
				"limit" => $request['limit']
			]);
		}
		
		public function createWalletAddress($request){
			$request['seed_wif'] = isset($request['seed_wif'])==false ?null:$request['seed_wif'];
			
			return $this->request("POST","/ltc/wallet/{$request['wallet_id']}/address",[
				"seed_wif" => $request['seed_wif']
			]);
		}		
		
		public function getWalletBalance($request){
			
			return $this->request("GET","/ltc/wallet/{$request['wallet_id']}/balance");
		}
				
		
		public function getWalletTransaction($request){
			$request['category'] = isset($request['category'])==false ?'all':$request['category'];
			$request['order'] = isset($request['order'])==false ?'desc':$request['order'];
			
			$request['offset'] = isset($request['offset'])==false ?0:$request['offset'];
			$request['limit'] = isset($request['limit'])==false ?10:$request['limit'];
			
			return $this->request("GET","/ltc/wallet/{$request['wallet_id']}/transaction",[
				"category" => $request['category'],
				"order" => $request['order'],
				"offset" => $request['offset'],
				"limit" => $request['limit']
			]);
		}
			
		public function sendToAddress($request){
			if(isset($request['kbfee']) == false){
				$blockChain = $this->getBlockChain();
				$request['kbfee'] = $blockChain['medium_fee_per_kb'];
			}
			
			$request['seed_wif'] = isset($request['seed_wif'])==false ?null:$request['seed_wif'];
			
			return $this->request("POST","/ltc/wallet/{$request['wallet_id']}/sendtoaddress",[
				"address" => $request['address'],
				"amount" => $request['amount'],
				"seed_wif" => $request['seed_wif'],
				"kbfee" => $request['kbfee']
			]);
		}
		
		public function sendMany($request){
			
			$request['seed_wif'] = isset($request['seed_wif'])==false ?null:$request['seed_wif'];
			
			return $this->request("POST","/ltc/wallet/{$request['wallet_id']}/sendmany",[
				"to" => $request['to'],
				"seed_wif" => $request['seed_wif']
			]);
		}
		
		public function sendTransaction($request){
			
			return $this->request("POST","/ltc/transaction",[
				"sign_hex" => $request['sign_hex']
			]);
		}		
		
		public function getTransaction($request){
			
			return $this->request("GET","/ltc/transaction/{$request['hash']}");
		}
	}
?>