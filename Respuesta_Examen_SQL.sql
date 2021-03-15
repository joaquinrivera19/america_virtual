1. Listar los datos de los autores que tengan más de un libro publicado.

  ```
  select * from Autor as a
  inner join LibAut as la on a.IdAutor = la.IdAutor
  inner join Libro as l on la.IdLibro = l.IdLibro
  ```

2. Listar nombre y edad de los estudiantes

  ```
  select Nombre, Edad from Estudiante
  ```

3. ¿Qué estudiantes pertenecen a la carrera de Informática?

  ```
  select * from Estudiante where Carrera = 'Informática'
  ```

4. Listar los nombres de los estudiantes cuyo apellido comience con la letra G?

  ```
  select Nombre from Estudiante where Nombre like 'G%'
  ```

5. ¿Quiénes son los autores del libro “Visual Studio Net”, listar solamente los nombres?

  ```
  select a.Nombre from Autor as a
  inner join LibAut as la on a.IdAutor = la.IdAutor
  inner join Libro as l on la.IdLibro = l.IdLibro
  where l.Titulo = 'Visual Studio Net'
  ```

6. ¿Qué autores son de nacionalidad “USA” o “Francia”?

  ```
  select * from Autor
  where Nacionalidad in ('USA','Francia')
  ```

7. ¿Qué libros NO Son del Area “CABA”?

  ```
  select * from Libro
  where Area <> 'CABA'
  ```

8. ¿Qué libros se prestó del Lector “Felipe Loayza Beramendi”?

  ```
  select l.Titulo from Estudiante as e
  inner join Prestamo as p on p.IdLector = e.IdLector
  inner join Libro as l on l.IdLibro = p.IdLibro
  where e.Nombre = 'Felipe Loayza Beramendi'
  ```

9. Listar el nombre del estudiante de menor edad

  ```
  select Nombre from Estudiante where Edad < 18

  ```

10. Listar los nombres de los estudiantes que se prestaron Libros del área “BUENOS AIRES”

  ```
  select Nombre from Estudiante as e
  inner join Prestamo as p on p.IdLector = e.IdLector
  inner join Libro as l on l.IdLibro = p.IdLibro
  where l.Area = 'BUENOS AIRES'
  ```

11. Listar los libros de editorial “ALFA” y de “OMEGA”

  ```
  select * from Libro
  where Editorial in('ALFA','OMEGA')
  ```

12. Listar los libros que pertenecen al autor “FELIPE PIGNA”

  ```
  select l.Titulo from Autor as a
  inner join LibAut as la on a.IdAutor = la.IdAutor
  inner join Libro as l on la.IdLibro = l.IdLibro
  where a.Nombre = 'FELIPE PIGNA'
  ```

13. Listar los títulos de los libros que debían devolverse el “10/04/2020”

  ```
  select l.Titulo from Libro as l
  inner join Prestamo as p on l.IdLibro = p.IdLibro
  where p.FechaDevolucion = '10/04/2020'
  ```

14. Hallar el promedio de edad de los estudiantes

  ```
  select AVG(Edad) from Estudiante
  ```

15. Listar los datos de los estudiantes cuya edad es mayor al promedio

  ```
  select * from Estudiante
  HAVING Edad > AVG(Edad)
  ```

16. Crear un Stored Procedure que muestre los libros de un determinado Autor que se especifique.

  ```
  create procedure proc_libro_det_autor (in autor varchar(50))
  begin

  select l.Titulo from Autor as a
  inner join LibAut as la on a.IdAutor = la.IdAutor
  inner join Libro as l on la.IdLibro = l.IdLibro
  where a.Nombre = autor

  end


  call proc_libro_det_autor('nombre_autor');
  ```

17. Crear un Stored Procedure que inserte nuevos Estudiantes

  ```
  create procedure proc_insert_est (IN ci varchar(50), IN nombre varchar(50), IN direccion varchar(50), IN carreta varchar(50), IN edad varchar(50))
  begin

  insert into Estudiante ('CI','Nombre','Direccion','Carreta','Edad') values (ci,nombre,direccion,carreta,edad)

  end


  call proc_insert_est(ci,nombre,direccion,carreta,edad);
  ```

18. Crear un Stored Procedure que actualice cualquier Libro especificando su código.

  ```
  create procedure proc_update_libro (IN idlibro int, IN titulo varchar(50), IN editorial varchar(50), IN area varchar(50))
  begin

  update Libro set Titulo = titulo, Editorial = editorial, Area = area where IdLibro = idlibro

  end


  call proc_update_libro(idlibro,titulo,editorial,area);
  ```

21. ¿Cuáles son las diferencias entre los comandos ‘delete’ y ‘truncate’

    Delete: comando que se utiliza para borra una tabla completa (estructura y datos) o una serie de filas de la tabla utilizando la claúsula where. No resetea el campo identity de la tabla.
    Truncate: comando que se utiliza para elimina todas las filas de la tabla sin borrar la tabla. Resetea el campo identity de la tabla.

22. ¿Puedes decir que los valores NULL equivalen a cero?

    NO.
    NULL es la ausencia de un valor. Un cuadro vacío representaría NULL.
    Cero es un valor.


24. Genere una sentencia para crear una tabla vacía llamada AUTOR2 identica a la tabla AUTOR que ya tiene datos.

```
  --
  -- Estructura de tabla para la tabla `AUTOR2`
  --

  CREATE TABLE `AUTOR2` (
    `IdAutor` int(11) NOT NULL,
    `Nombre` varchar(50) DEFAULT NULL,
    `Nacionalidad` varchar(50) DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

  --
  -- Indices de la tabla `AUTOR2`
  --
  ALTER TABLE `AUTOR2`
    ADD PRIMARY KEY (`IdAutor`);


  --
  -- AUTO_INCREMENT de la tabla `AUTOR2`
  --
  ALTER TABLE `AUTOR2`
    MODIFY `IdAutor` int(11) NOT NULL AUTO_INCREMENT;
```