import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, Router } from '@angular/router';



@Injectable()
export class AuthLogout {

    constructor (private router: Router) {

    }

    onLogout() {
        localStorage.clear();
        this.router.navigate(['/login']);
    }

}
