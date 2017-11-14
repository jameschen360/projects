import { Component, Inject, OnInit, ViewContainerRef } from '@angular/core';
import { FormArray, FormBuilder, FormControl, FormGroup, NgForm, Validators } from '@angular/forms';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material';
import { ProcessingModalService } from '../../../../server/processing-table/processing-modal.service';
import { MatSnackBar } from '@angular/material';
// ES6 Modules or TypeScript
import swal from 'sweetalert2';

declare var $;

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
  processingRemoveData = {
    'id': '',
    'cart_id': '',
    'token': '',
    'order_id': ''
  };
  markAsDeliveredData = {
    'id': '',
    'token': '',
    'order_id': '',
    'totalAmount': ''
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
    public getData: ProcessingModalService, public snackBar: MatSnackBar) {

    const userData = JSON.parse(localStorage.getItem('userData'));
    this.userDetails = userData.userData;
    this.token = userData.token;
    this.processingModalPostData.id = this.userDetails.id;
    this.processingModalPostData.token = this.token;
    this.processingModalPostData.processing_order_id = this.data.orderID;
  }

  onNoClick(): void {
    this.dialogRef.close();
  }

  ngOnInit() {
    this.cartForm = new FormGroup({
      'totalFinal': new FormControl(null, [Validators.required]),
      'amount': new FormArray([])
    });
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


  markDelivered() {
    this.markAsDeliveredData.id = this.userDetails.id;
    this.markAsDeliveredData.order_id = this.data.orderID;
    this.markAsDeliveredData.token = this.token;
    this.markAsDeliveredData.totalAmount = this.cartForm.value.totalFinal;

    $('#markDelivered').html('Processing...<span class="fa fa-spinner fa-spin"></span>').prop('disabled', true);
    swal({
      allowOutsideClick: false,
      allowEscapeKey: false,
      allowEnterKey: false,
      title: 'Are you sure you want mark this a delivered?',
      html: 'You cannot undo this action!',
      type: 'question',
      showCancelButton: true,
      showLoaderOnConfirm: true,
      confirmButtonColor: '#ffb606',
      cancelButtonColor: '#e87164',
      confirmButtonText: 'Yes!'

      }).then(() => {
        this.processingModalBusy = this.getData.postData(this.markAsDeliveredData, 'markAsDelivered').then((result) => {
          this.responseData = result;

          const table = $('#processingTable').DataTable();
          this.dialogRef.close();
          table
          .row( $('#orderNumber_' + this.data.orderID).parents('tr') )
          .remove()
          .draw();

          this.snackBar.open('Email has been sent to Customer', 'Close', {
            duration: 2000,
          });

        }, (err) => {
            // show some error
            console.log(err);
        });
      }, (dismiss) => {if ( dismiss === 'cancel') {
        $('#markDelivered').html('Mark as Delivered').prop('disabled', false);
      }});

  }


  removeFromCart(cartID) {
    cartID = cartID.id.split('_')[1];
    this.processingRemoveData.cart_id = cartID;
    this.processingRemoveData.id = this.userDetails.id;
    this.processingRemoveData.token = this.token;
    this.processingRemoveData.order_id = this.data.orderID;
    $('#remove_' + cartID).html('<span class="fa fa-spinner fa-spin"></span>').prop('disabled', true);
    swal({
      allowOutsideClick: false,
      allowEscapeKey: false,
      allowEnterKey: false,
      title: 'Are you sure you want to delete this item?',
      html: 'You cannot undo this action!',
      type: 'question',
      showCancelButton: true,
      showLoaderOnConfirm: true,
      confirmButtonColor: '#ffb606',
      cancelButtonColor: '#e87164',
      confirmButtonText: 'Yes!'

      }).then(() => {
        this.getData.postData(this.processingRemoveData, 'processingRemove').then((result) => {
          this.responseData = result;
          const message = this.responseData.msg;
          if (message === 'error') {
            this.snackBar.open('You cannot delete this', 'Close', {
              duration: 2000,
            });
            $('#remove_' + cartID).html('<span class="glyphicon glyphicon-remove"></span>').prop('disabled', false);
          } else {
            this.snackBar.open('You have deleted it!', 'Close', {
              duration: 2000,
            });
            $('#cart_' + cartID).remove();
          }
        }, (err) => {
            // show some error
        });
      }, (dismiss) => {if ( dismiss === 'cancel') {
        $('#remove_' + cartID).html('<span class="glyphicon glyphicon-remove"></span>').prop('disabled', false);
      }});


  }

}
