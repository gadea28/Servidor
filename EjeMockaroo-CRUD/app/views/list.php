
<form>
<button type="submit" name="orden" value="Nuevo"> Cliente Nuevo </button><br>
</form>
<form action="#" method="GET">
   <label for="ord">Ordenar por:</label>
   <select name="ord" id="ord">
      <option value="first_name">Nombre</option>
      <option value="last_name">Apellido</option>
      <option value="email">Correo Electrónico</option>
      <option value="gender">Género</option>
      <option value="ip_address">IP</option>
   </select>
   <button type="submit" name="nav" value="Ordenar">Ordenar</button>
</form>

<br>

<table>
<th><a href="?ord=id">ID</a></th>
<th><a href="?ord=first_name">Nombre</a></th>
<th><a href="?ord=email">Correo Electrónico</a></th>
<th><a href="?ord=gender">Género</a></th>
<th><a href="?ord=ip_address">IP</a></th>
<th><a href="?ord=telefono">Teléfono</a></th>

<?php foreach ($tvalores as $valor): ?>
<tr>
<td><?= $valor->id ?> </td>
<td><?= $valor->first_name ?> </td>
<td><?= $valor->email ?> </td>
<td><?= $valor->gender ?> </td>
<td><?= $valor->ip_address ?> </td>
<td><?= $valor->telefono ?> </td>
<td><a href="#" onclick="confirmarBorrar('<?=$valor->first_name?>',<?=$valor->id?>);" >Borrar</a></td>
<td><a href="?orden=Modificar&id=<?=$valor->id?>">Modificar</a></td>
<td><a href="?orden=Detalles&id=<?=$valor->id?>" >Detalles</a></td>

<tr>
<?php endforeach ?>
</table>

<form>
<br>
<button type="submit" name="nav" value="Primero"> << </button>
<button type="submit" name="nav" value="Anterior"> < </button>
<button type="submit" name="nav" value="Siguiente"> > </button>
<button type="submit" name="nav" value="Ultimo"> >> </button>
</form>
