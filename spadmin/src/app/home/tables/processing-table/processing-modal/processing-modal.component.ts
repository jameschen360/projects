import { Component, Inject, OnInit, ViewContainerRef } from '@angular/core';
import { FormControl, FormGroup, NgForm, Validators } from '@angular/forms';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material';
import { ToastsManager } from 'ng2-toastr/ng2-toastr';
import { ToastrOptions } from '../../../../shared/toastr-options';

import { ProcessingModalService } from '../../../../server/processing-table/processing-modal.service';

@Component({
  selector: 'app-processing-modal',
  templateUrl: './processing-modal.component.html',
  styleUrls: ['./processing-modal.component.css']
})
export class ProcessingModalComponent implements OnInit {
  cartForm: FormGroup;

  public responseData: any;
  public userDetails: any;
  public token: string;
  processingModalBusy: Promise<any>;
  processingModalPostData = {
    'id': '',
    'processing_order_id': '',
    'token': ''
  };

  processingAmountChangeData = {
    'id': '',
    'cart_id': '',
    'amount': '',
    'token': ''
  };
  // order response parameters
  userInfo: any;
  cartInfos: any;
  productInfos: any;
  orderInfo: any;

  userFullname: string;
  userAddress: string;
  userEmail: string;
  userPhone: string;

  orderTime: string;
  deliveryType: string;
  store: string;

  constructor(public dialogRef: MatDialogRef<ProcessingModalComponent>, @Inject(MAT_DIALOG_DATA) public data: any,
    public getData: ProcessingModalService,
    public toastr: ToastsManager, vcr: ViewContainerRef,
    public toastrOptions: ToastrOptions) {

    this.toastr.setRootViewContainerRef(vcr);

    const userData = JSON.parse(localStorage.getItem('userData'));
    this.userDetails = userData.userData;
    this.token = userData.token;
    this.processingModalPostData.id = this.userDetails.id;
    this.processingModalPostData.token = this.token;
    this.processingModalPostData.processing_order_id = this.data.orderID;
    this.getProcessingTable();
  }

  onNoClick(): void {
    this.dialogRef.close();
  }

  ngOnInit() {
    this.cartForm = new FormGroup({
      'totalFinal': new FormControl(null, [Validators.required])
    });
    // this.cartForm.valueChanges.subscribe(
    //   (value) => console.log(value)
    // );
  }

  getProcessingTable() {
    this.processingModalBusy = this.getData.postData(this.processingModalPostData, 'processingModal').then((result) => {
      this.responseData = result;
      this.userInfo = this.responseData.userInfo;
      this.cartInfos = this.responseData.cartData;
      this.productInfos = this.responseData.product;
      this.orderInfo = this.responseData.orderInfo;

      this.userFullname = this.userInfo.fname + ' ' + this.userInfo.lname;
      this.userAddress = this.userInfo.address + ' ' + this.userInfo.pcode;
      this.userEmail = this.userInfo.email;
      this.userPhone = this.userInfo.phone;

      this.orderTime = this.orderInfo.order_time;
      this.deliveryType = this.orderInfo.delivery_method;
      this.store = this.orderInfo.store;

    }, (err) => {
      // do something if error
    });
  }

  markDelivered(form: NgForm) {
    // this.dialogRef.close();
    console.log(this.cartForm);
  }

  removeFromCart() {

  }

  editCartAmount(amount, cartID) {
    cartID = cartID.id.split('_')[1];
    amount = amount.value;
    this.processingAmountChangeData.amount = amount;
    this.processingAmountChangeData.cart_id = cartID;
    this.processingAmountChangeData.id = this.userDetails.id;
    this.processingAmountChangeData.token = this.token;

    if (amount <= 0) {
      this.toastr.error('This is not good!', 'Oops!');
    } else {
      // send to http
    }
  }

}
