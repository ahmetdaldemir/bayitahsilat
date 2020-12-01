import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { NgxDatatableModule } from '@swimlane/ngx-datatable';
import { NgxPaginationModule } from 'ngx-pagination';
import { SharedComponentsModule } from 'src/app/shared/components/shared-components.module';
import { PaymentRoutingModule } from './payment-routing.module';
import { BalanceComponent } from './balance/balance.component';
import { FormComponent } from './form/form.component';
import { FailComponent } from './fail/fail.component';
import { OkComponent } from './ok/ok.component';
import { HistoryComponent } from './history/history.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { TextMaskModule } from 'angular2-text-mask';
import { CustomFormsModule } from 'ngx-custom-validators';
import { ReactiveFormsModule, FormsModule } from '@angular/forms';
import { SharedModule } from 'src/app/shared/shared.module';
import { TagInputModule } from 'ngx-chips';


@NgModule({
  imports: [
    CommonModule,
    NgbModule,
    PaymentRoutingModule,
    CommonModule,
    FormsModule,
    ReactiveFormsModule,SharedModule,
    CustomFormsModule,
    NgbModule,
    TagInputModule,TextMaskModule,ReactiveFormsModule,
    NgxPaginationModule,
    NgxDatatableModule,
    SharedComponentsModule
    
  ],
   declarations: [BalanceComponent,FormComponent,HistoryComponent,FailComponent,OkComponent]
})
export class PaymentModule { }
 