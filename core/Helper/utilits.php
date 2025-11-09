<?php

    if (! function_exists('validateDate')) {
        /**
         * baseUrl
         *
         * @return string
         */
        function baseUrl()
        {
            return $_ENV['BASEURL'];
        }
    }
    
    if (! function_exists('validateDate')) {
        /**
         * validateDate
         *
         * @param mixed $date 
         * @param string $format 
         * @return bool
         */
        function validateDate($date, $format = 'Y-m-d H:i:s')
        {
            $d = DateTime::createFromFormat($format, $date);
            return $d && $d->format($format) == $date;
        }
    }

    if (! function_exists('tempoCadastrado')){
        function tempoCadastrado($dataCriacao) {
            $agora = new DateTime();
            $criado = new DateTime($dataCriacao);
            $diff = $agora->diff($criado);

            if ($diff->y > 0) {
                return $diff->y . ' ano' . ($diff->y > 1 ? 's' : '');
            } elseif ($diff->m > 0) {
                return $diff->m . ' mês' . ($diff->m > 1 ? 'es' : '');
            } elseif ($diff->d > 0) {
                return $diff->d . ' dia' . ($diff->d > 1 ? 's' : '');
            } elseif ($diff->h > 0) {
                return $diff->h . ' hora' . ($diff->h > 1 ? 's' : '');
            } elseif ($diff->i > 0) {
                return $diff->i . ' minuto' . ($diff->i > 1 ? 's' : '');
            } else {
                return 'agora mesmo';
            }
        }
    }

    if(! function_exists('tempoPublicacao')){
        function tempoPublicacao($dataPublicacao) {
            if (empty($dataPublicacao)) {
                return "Data não informada";
            }

            $hoje = new DateTime();
            $publicacao = new DateTime($dataPublicacao);
            $diff = $hoje->diff($publicacao);

            if ($diff->days == 0) {
                return "Publicada hoje";
            } elseif ($diff->days == 1) {
                return "Publicada há 1 dia";
            } elseif ($diff->days < 30) {
                return "Publicada há {$diff->days} dias";
            } elseif ($diff->m >= 1 && $diff->y == 0) {
                return "Publicada há {$diff->m} mês" . ($diff->m > 1 ? 'es' : '');
            } elseif ($diff->y >= 1) {
                return "Publicada há {$diff->y} ano" . ($diff->y > 1 ? 's' : '');
            } else {
                return "Publicada há algum tempo";
            }
        }
    }

    if(! function_exists('chipsComSeparador')){
        function chipsComSeparador(array $itens): string {
            $itens = array_values(array_filter(array_map('trim', $itens), fn($v)=>$v!==''));
            if (empty($itens)) return '';

            $chipSep = '<span class="chip chip--sep" aria-hidden="true">•</span>';
            $chips = array_map(
                fn($txt) => '<span class="chip">'.htmlspecialchars($txt, ENT_QUOTES, 'UTF-8').'</span>',
                $itens
            );
            return implode($chipSep, $chips);
        }
    }