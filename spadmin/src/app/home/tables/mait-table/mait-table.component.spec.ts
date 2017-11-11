import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { MaitTableComponent } from './mait-table.component';

describe('MaitTableComponent', () => {
  let component: MaitTableComponent;
  let fixture: ComponentFixture<MaitTableComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ MaitTableComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(MaitTableComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
