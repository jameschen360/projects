import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { DeliveredTableComponent } from './delivered-table.component';

describe('DeliveredTableComponent', () => {
  let component: DeliveredTableComponent;
  let fixture: ComponentFixture<DeliveredTableComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ DeliveredTableComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(DeliveredTableComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
