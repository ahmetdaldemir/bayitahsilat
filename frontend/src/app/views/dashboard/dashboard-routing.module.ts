import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { DashboadDefaultComponent } from './dashboad-default/dashboad-default.component';
import { ProfilComponent } from './profil/profil.component';

const routes: Routes = [
  {
    path: 'v1',
    component: DashboadDefaultComponent
  }, 
  {
    path: 'profil',
    component: ProfilComponent
  },

];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class DashboardRoutingModule { }
