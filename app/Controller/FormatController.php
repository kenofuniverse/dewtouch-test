<?php
	class FormatController extends AppController{
		
		public function q1(){
			
			$this->setFlash('Question: Please change Pop Up to mouse over (soft click)');
				
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}
		
		public function q1_detail(){

			$this->setFlash('Question: Please change Pop Up to mouse over (soft click)');
				
			
			
// 			$this->set('title',__('Question: Please change Pop Up to mouse over (soft click)'));
		}

		public function q1_result() {
			if ($this->request->data['Type']['type'] !== '') {
				$this->set('selected', $this->request->data['Type']['type']);
			} else {
				$this->set('selected', __('Nothing is selected'));
			}
		}
		
	}