<tr class="parent_id">
    <td class="text-center align-middle">
        <a href="#">
            <i class="fas fa-trash table-remove" style="font-size: 15px;color: #bfbfbf"></i>
        </a>
    </td>
    <td>
        @include('layout.component.input',[
            'type'    =>  'sanpham',
            'id'      =>  'product_id',
            'name'    =>  'product_id[]',
            'position'=>  'A-',
            'pass'    =>  'yes',
            'required'=>  'required',
        ])
    </td>
    <td>
        <input id="quantity" class="form-control form-control-sm quantity decimal" name="quantity[]" required type="text">
    </td>
    <td>
        <input id="cost" class="form-control form-control-sm cost decimal" name="cost[]" required type="text">
    </td>
    <td>
        <input id="total" class="form-control form-control-sm total decimal" name="total[]" type="text"  readonly>
    </td>
    <td>
        <input id="manufacture" class="form-control form-control-sm manufacture" name="manufacture[]" type="date">
    </td>
    <td>
        <input id="expired" class="form-control form-control-sm expired" type="date" name="expired[]">
    </td>
</tr>
