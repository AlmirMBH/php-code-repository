<?php

declare(strict_types = 1);

/**
 * Value object is a small object that represents a simple entity whose equality is not based on identity. Two value
 * objects are equal if they have the same value, not necessarily being the same object.
 * Entities usually have IDs, while value objects do not have identifiers. 
 * Value objects usually represent something that is quantifiable, measurable or they simply describe something e.g.
 * amount, weight, address, email, phone number, etc.
 * Value objects must be immutable and the reason for theat is to be able to share value objects safely. Each value
 * object should be valid by default.
 * Value objects are usally part of Domain driven design (DDD).
 * ENTITY: has ID, is mutable and has logic inside
 * DTO: has no ID, is not mutable, has no logic inside
 * VO: has no ID, is not mutable, has logic inside
 * 
 * Billable weigth max(DIM Weight, Weight)
 * DIM Weight is dimensional weight; weight is the actual weight
 * The billable weight is the one that is greater between the two
 */

class BillableWeightCalculatorService{

                                // width, height and lenght could be a value object in specific cases
    public function calculate(PackageDimension $packageDimension, Weight $weight, DimDivisor $dimDivisor): int {

        $dimWeight = (int) round(
            ($packageDimension->width * $packageDimension->height * $packageDimension->length) / $dimDivisor->value
        );

        return max($weight->value, $dimWeight);
    }
}


class PackageDimension {

    public function __construct(
        public readonly int $width,
        public readonly int $height, 
        public readonly int $length) 
    {
        match(true){
            $this->width <= 0 || $this->width > 80 => throw new \InvalidArgumentException('Invalida package width'),
            $this->height <= 0 || $this->height > 70 => throw new \InvalidArgumentException('Invalida package height'),
            $this->length <= 0 || $this->length > 120 => throw new \InvalidArgumentException('Invalida package length'),
            default => true
        };
    }

    public function increaseWidth(int $width): self {
        // $this->width += $width; // this is not possible due to readonly property
        return new self($this->width + $width, $this->height, $this->length);
    }

    public function equalTo(PackageDimension $other){
        return $this->width === $other->width
            && $this->height === $other->height 
            && $this->length === $other->length;
    }
}



class Weight {

    public function __construct(public readonly int $value){
        match(true){
            $this->value <= 0 || $this->value > 150 => throw new \InvalidArgumentException('Invalida package weight'),
            default => true
        };
     }

     public function equalTo(PackageDimension $other){
        return $this->value === $other->value;
    }
}


enum DimDivisor: int {

    case FEDEX = 139;
    case EXPRESS = 240;

}




echo "VALUE OBJECTS<br>";
$package = [
    'weight' => 6,
    'dimensions' => [
        'width' => 9,
        'length' => 15,
        'height' => 7
    ]
];

$billableService = new BillableWeightCalculatorService();

$packageWeight = new Weight($package['weight']);

$packageDimensions = new PackageDimension(
                            $package['dimensions']['width'], 
                            $package['dimensions']['height'], 
                            $package['dimensions']['length']);

$widerPackageDimensions = $packageDimensions->increaseWidth(10); // new object not changing the original width - readonly


$billableWeight = $billableService->calculate($packageDimensions, $packageWeight, DimDivisor::FEDEX);
$widerPackageBillableWeight = $billableService->calculate($widerPackageDimensions, $packageWeight, DimDivisor::FEDEX);

echo $billableWeight . ' lb<br>';
echo $widerPackageBillableWeight . ' lb<br>';


