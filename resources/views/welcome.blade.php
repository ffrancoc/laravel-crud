<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <div class="vw-100 vh-100 d-flex align-items-center mt-5 flex-column ">
        <h2>CRUD Simple en PHP, Mysql y Laravel</h2>                

        <script>
            function eliminar(producto){
                let res = confirm("¿El producto "+producto+" se eliminara, esta seguro?")
                return res;
            }
        </script>
 
        <!-- Modal para guardar nuevo registro -->
        <div class="modal fade" id="modalSave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Guardar nuevo registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route("crud.create")}}" method="POST">                        
                            @csrf
                            <div class="form-group">
                            <label for="txtnombre">Nombre de Producto</label>
                            <input type="text" class="form-control" id="txtnombre" name="txtnombre" required>
                            </div>
                            <div class="form-group">
                            <label for="txtcantidad">Cantidad de producto</label>
                            <input type="number" min="1" step="1" class="form-control" id="txtcantidad" name="txtcantidad" required>
                            </div>
                            <div class="form-group">
                            <label for="tprecio">Precio del producto</label>
                            <input type="number" min="1" step="0.50" class="form-control" id="txtprecio" name="txtprecio" required>
                            </div>                                          
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>                        
                        </form>
                    </div>
                </div>  
            </div>
        </div>


        <div class="p-5 container-fluid">
            @if (session("correcto"))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session("correcto")}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>                
              </div>        
            @elseif (session("incorrecto"))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session("incorrecto")}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            

            <table class="table table-responsive table-striped table-hover  ">
                <thead class="table-success">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NOMBRE</th>
                        <th scope="col">CANTIDAD</th>
                        <th scope="col">PRECIO</th>
                        <th><a href="#" class="btn btn-sm btn-success " data-toggle="modal" data-target="#modalSave"><i class="bi bi-plus-square"></i> Agregar</a></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td class="p-2">{{$item->id}}</td>
                        <td class="p-2">{{$item->nombre}}</td>
                        <td class="p-2">{{$item->cantidad}}</td>
                        <td class="p-2">{{$item->precio}}</td>
                        <td class="p-2">
                            <div>
                                <a class="btn btn-sm  btn-warning " data-toggle="modal" data-target="#modalUpdate{{$item->id}}"><i class="bi bi-pencil-square"></i></a>
                                <a href="{{route("crud.delete", $item->id)}}" onclick="return eliminar('{{ $item->nombre}}')" class="btn btn-sm btn-danger"><i class="bi bi-trash-fill"></i></a>
                            </div>
                        </td>
                    </tr>
                    <!-- Modal para actualizar nuevo registro -->
                    <div class="modal fade" id="modalUpdate{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Guardar nuevo registro</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route("crud.update")}}" method="POST">                        
                                        @csrf
                                        <div class="form-group">
                                            <label for="txtid">Id del Producto</label>
                                            <input type="number" class="form-control" id="txtid" name="txtid" value="{{$item->id}}" readonly required>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtnombre">Nombre de Producto</label>
                                            <input type="text" class="form-control" id="txtnombre" name="txtnombre" value="{{$item->nombre}}" required>
                                        </div>
                                        <div class="form-group">
                                        <label for="txtcantidad">Cantidad de producto</label>
                                        <input type="number" min="1" step="1" class="form-control" id="txtcantidad" name="txtcantidad" value="{{$item->cantidad}}" required>
                                        </div>
                                        <div class="form-group">
                                        <label for="tprecio">Precio del producto</label>
                                        <input type="number" min="1" step="0.50" class="form-control" id="txtprecio" name="txtprecio" value="{{$item->precio}}" required>
                                        </div>                                          
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Actualizar</button>
                                        </div>                        
                                    </form>
                                </div>
                            </div>  
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>