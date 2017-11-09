import { Component, OnInit } from '@angular/core';
import { ContentService } from '../../../getData/content.service';

declare var $: any;

@Component({
  selector: 'app-processing-table',
  templateUrl: './processing-table.component.html',
  styleUrls: ['./processing-table.component.css'],
})
export class ProcessingTableComponent implements OnInit {

  public userDetails: any;
  public responseData;
  public token: string;
  processingTablePostData = {
    'id': '',
    'token': ''
  };
  processingOrderBusy: Promise<any>;

  constructor(public getData: ContentService) {
    const data = JSON.parse(localStorage.getItem('userData'));
    this.userDetails = data.userData;
    this.token = data.token;
    this.processingTablePostData.id = this.userDetails.id;
    this.processingTablePostData.token = this.token;
    this.getProcessingTable();
  }

  ngOnInit() {

  }

  getProcessingTable () {
   this.processingOrderBusy = this.getData.postData(this.processingTablePostData, 'processingTable').then((result) => {
      this.responseData = result;
      $(function (){
        $('#processingTable').DataTable({
          responsive: true
        });
      });
    }, (err) => {
    });
  }

  viewProcessingModal(event) {
    console.log(event.target.id);
  }

}
