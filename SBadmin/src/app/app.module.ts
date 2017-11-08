import { NgModule } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { HttpModule } from '@angular/http';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { AuthGuard } from './auth/auth-guard.service';
import { AuthPreventLoginPage } from './auth/auth-prevent-login-page.services';
import { AuthService } from './auth/auth.service';
import { HeaderComponent } from './home/header/header.component';
import { HomeComponent } from './home/home.component';
import { TablesComponent } from './home/tables/tables.component';
import { LoginComponent } from './login/login.component';
import { MatMaterialModule } from './mat-material.module';
import { NotFoundComponent } from './not-found/not-found.component';
import { ProcessOrderComponent } from './process-order/process-order.component';

@NgModule({
  declarations: [
    AppComponent,
    ProcessOrderComponent,
    LoginComponent,
    HomeComponent,
    NotFoundComponent,
    TablesComponent,
    HeaderComponent
  ],
  imports: [
    BrowserModule,
    FormsModule,
    HttpModule,
    AppRoutingModule,
    MatMaterialModule
  ],
  providers: [
    AuthService,
    AuthGuard,
    AuthPreventLoginPage
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
