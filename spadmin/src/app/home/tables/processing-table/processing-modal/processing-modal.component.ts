import { Component, OnInit, Inject } from '@angular/core';

import {MatDialog, MatDialogRef, MAT_DIALOG_DATA} from '@angular/material';

@Component({
  selector: 'app-processing-modal',
  templateUrl: './processing-modal.component.html',
  styleUrls: ['./processing-modal.component.css']
})
export class ProcessingModalComponent implements OnInit {
  constructor(
    public dialogRef: MatDialogRef<ProcessingModalComponent>,
    @Inject(MAT_DIALOG_DATA) public data: any) { }

  onNoClick(): void {
    this.dialogRef.close();
  }

  ngOnInit() {
    console.log(this.data.orderID);
  }


}
