<?php
namespace Akuren\Validator;

class ValidationErrors
{
    private $key;
    private $rule;
    
    private $messages = [
        'required' => 'Le champ %s est requis',
        'slug' => 'Le champ  n\'est pas un slug valide' ,
        'empty' => 'Le champ ne peut etre vide',
        'betweenLength' => 'Le champ  doit contenir entre %d et %d caractere',
        'minLength' => 'Le champ  doit contenir plus de %d caracteres',
        'maxLength' => 'Le champ  doit contenir moins de %d caracteres',
        'email' => 'Veillez enter une addresse email valide (Ex. contact@gmail.com)',
        'username' => 'Nom d\'utilisateur invalide (Alphanumerique)',
        'number' => 'Numero de telephone invalide (Ex. +228 98-64-73-06)',
        'datetime' => 'Le format de la date n\'est pas respecter'
    ];
    /**
     * @var array
     */
    private $attributes;
    
    /**
     * ValidationErrors constructor.
     * @param string $key
     * @param string $rule
     * @param array $attributes
     */
    public function __construct(string $key, string $rule, array $attributes)
    {
        $this->key = $key;
        $this->rule = $rule;
        $this->attributes = $attributes;
    }
    
    /**
     * @return string
     */
    public function __toString()
    {
        $params = array_merge([$this->messages[$this->rule], $this->key], $this->attributes);
        return (string) call_user_func_array('sprintf', $params);
    }
}