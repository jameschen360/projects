import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot } from '@angular/router';

import { LoginService } from '../server/login.service';



@Injectable()
export class AuthPreventLoginPage implements CanActivate {

    constructor (private authService: LoginService,
                 private router: Router) {

    }
    canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot) {
        if (localStorage.token != null) {
            this.router.navigate(['/dashboard']);
            return false;
        }
        return true;
    }
}
