import { Component, Inject, OnInit, ViewContainerRef } from '@angular/core';
import { FormArray, FormBuilder, FormControl, FormGroup, NgForm, Validators } from '@angular/forms';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material';
import { DeliveredTableService } from '../../../../server/delivered-table/delivered-table.service';
import { MatSnackBar } from '@angular/material';
// ES6 Modules or TypeScript
import swal from 'sweetalert2';

declare var $;

@Component({
  selector: 'app-delivered-modal',
  templateUrl: './delivered-modal.component.html',
  styleUrls: ['./delivered-modal.component.css']
})
export class DeliveredModalComponent implements OnInit {
  cartForm: FormGroup;
  public responseData: any;
  public userDetails: any;
  public token: string;
  deliveredModalBusy: Promise<any>;
  deliveredModalPostData = {
    'id': '',
    'order_id': '',
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
  totalAmount: string;
  deliveredTime: string;

  constructor(public dialogRef: MatDialogRef<DeliveredModalComponent>, @Inject(MAT_DIALOG_DATA) public data: any,
    public getData: DeliveredTableService, public snackBar: MatSnackBar) {

    const userData = JSON.parse(localStorage.getItem('userData'));
    this.userDetails = userData.userData;
    this.token = userData.token;
    this.deliveredModalPostData.id = this.userDetails.id;
    this.deliveredModalPostData.token = this.token;
    this.deliveredModalPostData.order_id = this.data.orderID;
  }

  onNoClick(): void {
    this.dialogRef.close();
  }

  ngOnInit() {
    this.cartForm = new FormGroup({
      'totalFinal': new FormControl(null, [Validators.required]),
      'amount': new FormArray([])
    });
    this.deliveredModalBusy = this.getData.postData(this.deliveredModalPostData, 'deliveredModal').then((result) => {
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
      this.totalAmount = this.orderInfo.totalAmount;
      this.deliveredTime = this.orderInfo.deliveredTime;
    }, (err) => {
      // do something if error
    });
  }

  closeDeliveryModal() {
    this.dialogRef.close();
  }


}
