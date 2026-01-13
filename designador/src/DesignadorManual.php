<?php
class DesignadorManual
{
    // Duración estimada de un partido para calcular conflictos (en minutos)
    private const DURACION_PARTIDO = 120;

    public function getArbitros(): array
    {
        return $_SESSION['lista_arbitros'] ?? [];
    }

    public function getPartidos(): array
    {
        return $_SESSION['lista_partidos'] ?? [];
    }

    public function getAsignaciones(): array
    {
        return $_SESSION['asignaciones'] ?? [];
    }

    /**
     * Añadir Árbitro a la sesión
     */
    public function agregarArbitro($nombre, $apellidos, $categoria)
    {
        $_SESSION['lista_arbitros'][] = [
            'id' => uniqid('arb_'), // ID único necesario para los values del select
            'nombre' => "$nombre $apellidos",
            'categoria' => $categoria
        ];
    }

    /**
     * Añadir Partido a la sesión con Género y lógica de divisiones
     */
    public function agregarPartido($div, $cat, $genero, $local, $visit, $pab, $fecha, $hora)
    {
        // Validación de Divisiones según reglas
        if ($cat === 'Senior') {
            if ($genero === 'M' && $div !== '3ª') {
                $div = '3ª'; // Forzar 3ª en Senior Masculino
            }
            // En Femenino aceptamos lo que venga (1ª Auto o 2ª)
        }

        $_SESSION['lista_partidos'][] = [
            'id' => uniqid('match_'),
            'div' => $div,
            'cat' => $cat,
            'genero' => $genero,
            'info' => "($genero) $cat $div | $local vs $visit",
            'local' => $local,
            'visitante' => $visit,
            'pabellon' => $pab,
            'fecha' => $fecha,
            'hora' => $hora
        ];
    }

    /**
     * Devuelve los árbitros disponibles para una fecha y hora específicas.
     * Excluye al árbitro si ya tiene partido en ese horario (±2 horas).
     * * @param string $partidoId ID del partido actual (para no excluirse a sí mismo si editamos)
     * @param string $fecha Fecha YYYY-MM-DD
     * @param string $hora Hora HH:MM
     */
    public function getArbitrosDisponibles(string $partidoId, string $fecha, string $hora): array
    {
        $todos = $this->getArbitros();
        $asignaciones = $this->getAsignaciones();
        $disponibles = [];

        $inicioNuevo = strtotime("$fecha $hora");
        $finNuevo = $inicioNuevo + (self::DURACION_PARTIDO * 60);

        foreach ($todos as $arbitro) {
            $ocupado = false;

            // Revisar si este árbitro está en las asignaciones guardadas
            foreach ($asignaciones as $pid => $data) {
                // Si la asignación es del mismo partido que estamos editando, ignoramos el conflicto
                if ($pid === $partidoId)
                    continue;

                // Si el árbitro está en ese partido
                if ($data['principal'] === $arbitro['id'] || $data['auxiliar'] === $arbitro['id']) {
                    // Recuperar hora del partido conflictivo
                    $partidoConflictivo = $this->getPartidoById($pid);
                    if ($partidoConflictivo) {
                        $inicioConf = strtotime("{$partidoConflictivo['fecha']} {$partidoConflictivo['hora']}");
                        $finConf = $inicioConf + (self::DURACION_PARTIDO * 60);

                        // Comprobar solapamiento de tiempos
                        // (StartA < EndB) and (EndA > StartB)
                        if ($inicioNuevo < $finConf && $finNuevo > $inicioConf) {
                            $ocupado = true;
                            break; // Ya encontramos conflicto, salimos
                        }
                    }
                }
            }

            if (!$ocupado) {
                $disponibles[] = $arbitro;
            }
        }

        // Ordenar por categoría para facilitar la elección (Grupo 1 primero)
        // Nota: Esto es visual, no obligatorio lógica
        usort($disponibles, function ($a, $b) {
            $orden = ['Grupo 1' => 5, 'Disponibles' => 4, 'Sub-25' => 3, 'ESGAR' => 2, 'Zonal' => 1];
            return ($orden[$b['categoria']] ?? 0) <=> ($orden[$a['categoria']] ?? 0);
        });

        return $disponibles;
    }

    public function guardarDesignacion($partidoId, $principalId, $auxiliarId)
    {
        if (!isset($_SESSION['asignaciones']))
            $_SESSION['asignaciones'] = [];
        $_SESSION['asignaciones'][$partidoId] = [
            'principal' => $principalId,
            'auxiliar' => $auxiliarId
        ];
    }

    private function getPartidoById($id)
    {
        foreach ($this->getPartidos() as $p) {
            if ($p['id'] === $id)
                return $p;
        }
        return null;
    }

    public function getNombreArbitro($id)
    {
        foreach ($this->getArbitros() as $a) {
            if ($a['id'] === $id)
                return $a['nombre'] . " (" . $a['categoria'] . ")";
        }
        return "No asignado";
    }
}
?>