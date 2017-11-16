import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot } from '@angular/router';

import { LoginService } from '../server/login.service';



@Injectable()
export class AuthPreventLoginPage implements CanActivate {

    constructor (public authService: LoginService,
        public router: Router) {

    }
    canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot) {
        if (localStorage.token != null) {
            this.router.navigate(['/dashboard']);
            return false;
        }
        return true;
    }
}
