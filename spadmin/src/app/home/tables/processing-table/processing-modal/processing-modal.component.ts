import { Component, OnInit, Inject } from '@angular/core';

import { MatDialog, MatDialogRef, MAT_DIALOG_DATA } from '@angular/material';

import { ProcessingModalService } from '../../../../server/processing-table/processing-modal.service';

@Component({
  selector: 'app-processing-modal',
  templateUrl: './processing-modal.component.html',
  styleUrls: ['./processing-modal.component.css']
})
export class ProcessingModalComponent implements OnInit {
  public responseData: any;
  public userDetails: any;
  public token: string;
  processingModalBusy: Promise<any>;
  processingModalPostData = {
    'id': '',
    'processing_order_id': '',
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
    public getData: ProcessingModalService) {

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

      console.log(this.responseData);

    }, (err) => {
      // do something if error
    });
  }


}
