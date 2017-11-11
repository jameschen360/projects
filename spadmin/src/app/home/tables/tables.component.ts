import { Component, OnInit } from '@angular/core';
import { Router, RouterModule } from '@angular/router';

@Component({
  selector: 'app-tables',
  templateUrl: './tables.component.html',
  styleUrls: ['./tables.component.css']
})
export class TablesComponent implements OnInit {
  routeLinks: any[];
  activeLinkIndex = 0;
  constructor(private router: Router) {
    this.routeLinks = [
      {label: 'Processing Orders', link: 'processingTable', icon: 'fa-edit', cssStyle: 'icon-style-edit'},
      {label: 'Delivered Orders', link: 'deliveredTable', icon: 'fa-check', cssStyle: 'icon-style-check'},
      {label: 'Users', link: 'userTable', icon: 'fa-user-o', cssStyle: 'icon-style-user'},
      {label: 'Maintenance', link: 'maitTable', icon: 'fa-gear', cssStyle: 'icon-style-gear'},
      {label: 'Products', link: 'productTable', icon: 'fa-list-ol', cssStyle: 'icon-style-product'},
    ];

  }

  ngOnInit() {
  }

}
