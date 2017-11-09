import { Component, OnInit } from '@angular/core';
import { AuthLogout } from '../../auth/auth-logout';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent implements OnInit {

  constructor(private authLogout: AuthLogout) { }

  ngOnInit() {
  }

  onLogoutClick() {
    this.authLogout.onLogout();
  }

}
