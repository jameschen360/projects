import { Component, OnInit } from '@angular/core';
import { Router, RouterModule, ActivatedRoute } from '@angular/router';
import { Location } from '@angular/common';


@Component({
  selector: 'app-tables',
  templateUrl: './tables.component.html',
  styleUrls: ['./tables.component.css']
})
export class TablesComponent implements OnInit {
  routeLinks: any[];
  activeLinkIndex = 0;
  selectedIndex = 0;

  constructor(private router: Router, private route: ActivatedRoute, private location: Location) {
    this.routeLinks = [
      { label: 'Processing Orders', link: 'processingTable', icon: 'fa-edit', cssStyle: 'icon-style-edit' },
      { label: 'Delivered Orders', link: 'deliveredTable', icon: 'fa-check', cssStyle: 'icon-style-check' },
      { label: 'Users', link: 'userTable', icon: 'fa-user-o', cssStyle: 'icon-style-user' },
      { label: 'Maintenance', link: 'maitTable', icon: 'fa-gear', cssStyle: 'icon-style-gear' },
      { label: 'Products', link: 'productTable', icon: 'fa-list-ol', cssStyle: 'icon-style-product' },
    ];

    if (router.url === '/dashboard/processingTable') {
      this.selectedIndex = 0;
    } else if (router.url === '/dashboard/deliveredTable') {
      this.selectedIndex = 1;
    } else if (router.url === '/dashboard/userTable') {
      this.selectedIndex = 2;
    } else if (router.url === '/dashboard/maitTable') {
      this.selectedIndex = 3;
    } else if (router.url === '/dashboard/productTable') {
      this.selectedIndex = 4;
    }
  }

  ngOnInit() {
    this.location.subscribe(currentLocation => {
      if (currentLocation.url === '/dashboard/processingTable') {
        this.selectedIndex = 0;
      } else if (currentLocation.url === '/dashboard/deliveredTable') {
        this.selectedIndex = 1;
      } else if (currentLocation.url === '/dashboard/userTable') {
        this.selectedIndex = 2;
      } else if (currentLocation.url === '/dashboard/maitTable') {
        this.selectedIndex = 3;
      } else if (currentLocation.url === '/dashboard/productTable') {
        this.selectedIndex = 4;
      }
    });
  }

  changeTab(e) {
    switch (e.index) {
    case 0:
        this.router.navigateByUrl('/dashboard/processingTable');
        break;
    case 1:
        this.router.navigateByUrl('/dashboard/deliveredTable');
        break;
    case 2:
        this.router.navigateByUrl('/dashboard/userTable');
        break;
    case 3:
        this.router.navigateByUrl('/dashboard/maitTable');
        break;
    case 4:
        this.router.navigateByUrl('/dashboard/productTable');
        break;
    }
  }
  
  selectNextTab() {
    this.selectedIndex++;
  }
}
