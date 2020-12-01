import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { FormComponent } from './form/form.component';
import { HistoryComponent } from './history/history.component';
import { BalanceComponent } from './balance/balance.component';
import { FailComponent } from './fail/fail.component';
import { OkComponent } from './ok/ok.component';


const routes: Routes = [
  {
    path: 'form',
      component: FormComponent
  },
  {
    path: 'history',
      component: HistoryComponent
  },
  {
    path: 'balance',
      component: BalanceComponent
  },
  {
    path: 'ok/:id',
      component: OkComponent
  },
  {
    path: 'fail/:id',
      component: FailComponent
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class PaymentRoutingModule { }
