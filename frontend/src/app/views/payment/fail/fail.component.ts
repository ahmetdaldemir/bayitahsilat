import { Component, OnInit } from '@angular/core';
import { MyService } from 'src/app/shared/services/myservice.service';
import { NgbModal } from '@ng-bootstrap/ng-bootstrap';
import { ToastrService } from 'ngx-toastr';
import { LocalStoreService } from "src/app/shared/services/local-store.service";
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-fail',
  templateUrl: './fail.component.html',
  styleUrls: ['./fail.component.scss'],
})
export class FailComponent implements OnInit {
  
  
  invoices: any[]
  id:string;

  constructor(
    private route: ActivatedRoute,
    private store: LocalStoreService,
    private ms: MyService,
    private modalService: NgbModal,
    private toastr: ToastrService
  ) { }

  ngOnInit() {
    console.log(this.store.getItem("id"));
    this.loadFail()
}

loadFail() {
  this.id = this.route.snapshot.params['id'];
  this.ms.getOk(this.id).subscribe(res => {  this.invoices = res; })
}

}
