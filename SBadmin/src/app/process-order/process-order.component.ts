import { Component, OnInit } from '@angular/core';
declare var jquery:any;
declare var $ :any;

@Component({
  selector: 'app-process-order',
  templateUrl: './process-order.component.html',
  styleUrls: ['./process-order.component.css']
})
export class ProcessOrderComponent implements OnInit {

  constructor() { }

  ngOnInit() {
  }

  customMethod() {
    $('.testClass').slideToggle().html('this jquery works');
  }

}
