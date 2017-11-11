import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { AuthGuard } from './auth/auth-guard.service';
import { AuthPreventLoginPage } from './auth/auth-prevent-login-page.services';
import { HomeComponent } from './home/home.component';
import { ProcessingTableComponent } from './home/tables/processing-table/processing-table.component';
import { DeliveredTableComponent } from './home/tables/delivered-table/delivered-table.component';
import { UserTableComponent } from './home/tables/user-table/user-table.component';
import { MaitTableComponent } from './home/tables/mait-table/mait-table.component';
import { ProductTableComponent } from './home/tables/product-table/product-table.component';
import { LoginComponent } from './login/login.component';
import { NotFoundComponent } from './not-found/not-found.component';

const appRoutes: Routes = [
    { path: '', redirectTo: '/login', pathMatch: 'full'},
    { path: 'login', component: LoginComponent, canActivate: [AuthPreventLoginPage] },
    { path: 'dashboard', redirectTo: 'dashboard/processingTable' },
    { path: 'dashboard', component: HomeComponent, canActivate: [AuthGuard], children: [
        { path: 'processingTable', component: ProcessingTableComponent },
        { path: 'deliveredTable', component: DeliveredTableComponent },
        { path: 'userTable', component: UserTableComponent },
        { path: 'maitTable', component: MaitTableComponent },
        { path: 'productTable', component: ProductTableComponent }
    ] },
    { path: '404', component: NotFoundComponent },
    { path: '**', redirectTo: '404' },
];

@NgModule({
    imports: [RouterModule.forRoot(appRoutes)],
    exports: [RouterModule]
})
export class AppRoutingModule {

}
