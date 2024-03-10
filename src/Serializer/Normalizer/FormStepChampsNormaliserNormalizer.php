<?php

namespace App\Serializer\Normalizer;

use App\Entity\FormStepChamps;
use Symfony\Component\Serializer\Normalizer\CacheableSupportsMethodInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class FormStepChampsNormaliserNormalizer implements NormalizerInterface, CacheableSupportsMethodInterface
{
    public function __construct(private ObjectNormalizer $normalizer)
    {
    }

    public function normalize($object, string $format = null, array $context = []): array
    {
       // $data = $this->normalizer->normalize($object, $format, $context);
         if ($object instanceof FormStepChamps){
             $data = [
                 'order'=>$object->getOrdre(),
                 'obligatoire'=>$object->isObligatoire(),
                 'actif'=>$object->isActif(),
                 'formStep'=>$object->getFormStep()->getTitre(),
                 'createdAt'=>$object->getCreatedAt(),
                 'updatedAt'=>$object->getUpdatedAt()
             ];
             return $data;
         }

        // TODO: add, edit, or delete some data


    }

    public function supportsNormalization($data, string $format = null, array $context = []): bool
    {
        return $data instanceof \App\Entity\FormStepChamps;
    }

    public function hasCacheableSupportsMethod(): bool
    {
        return true;
    }
}
