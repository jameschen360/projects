import { Component, Inject, OnInit, ViewContainerRef } from '@angular/core';
import { FormArray, FormBuilder, FormControl, FormGroup, NgForm, Validators } from '@angular/forms';
import { MAT_DIALOG_DATA, MatDialogRef } from '@angular/material';
import { UserTableService } from '../../../../server/user-table/user-table.service';

@Component({
  selector: 'app-user-modal',
  templateUrl: './user-modal.component.html',
  styleUrls: ['./user-modal.component.css']
})
export class UserModalComponent implements OnInit {
  public responseData: any;
  public userDetails: any;
  public token: string;
  userModalPostData = {
    'user_id': '',
    'customer_id': '',
    'token': ''
  };
  userDetail;
  fname;
  lname;
  email;
  address;
  pcode;
  phone;

  public loading = false;

  constructor(public dialogRef: MatDialogRef<UserModalComponent>, @Inject(MAT_DIALOG_DATA) public data: any,
  public getData: UserTableService) {
    const userData = JSON.parse(localStorage.getItem('userData'));
    this.userDetails = userData.userData;
    this.token = userData.token;
    this.userModalPostData.user_id = this.userDetails.id;
    this.userModalPostData.token = this.token;
    this.userModalPostData.customer_id = this.data.customerID;
  }

  ngOnInit() {
    this.loading = true;
    this.getData.postData(this.userModalPostData, 'userModal').then((result) => {
      this.responseData = result;
      this.userDetails = this.responseData.userDetail[0];
      this.fname = this.userDetails.fname;
      this.lname = this.userDetails.lname;
      this.email = this.userDetails.email;
      this.address = this.userDetails.address;
      this.pcode = this.userDetails.pcode;
      this.phone = this.userDetails.phone;

      this.loading = false;
    }, (err) => {
      // do something if error
    });
  }

  closeUserModal() {
    this.dialogRef.close();
  }

  onNoClick(): void {
    this.dialogRef.close();
  }

}
