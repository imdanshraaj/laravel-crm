<?php

namespace Webkul\Contact\Repositories;

use Illuminate\Container\Container;
use Webkul\Attribute\Repositories\AttributeValueRepository;
use Webkul\Core\Eloquent\Repository;

class PersonRepository extends Repository
{
    /**
     * Create a new repository instance.
     *
     * @return void
     */
    public function __construct(
        protected AttributeValueRepository $attributeValueRepository,
        Container $container
    ) {
        parent::__construct($container);
    }

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Webkul\Contact\Contracts\Person';
    }

    /**
     * @return \Webkul\Contact\Contracts\Person
     */
    public function create(array $data)
    {
        $person = parent::create($data);

        $this->attributeValueRepository->save($data, $person->id);

        return $person;
    }

    /**
     * @param  int  $id
     * @param  string  $attribute
     * @return \Webkul\Contact\Contracts\Person
     */
    public function update(array $data, $id, $attribute = 'id')
    {
        $person = parent::update($data, $id);

        $this->attributeValueRepository->save($data, $id);

        return $person;
    }

    /**
     * Retrieves customers count based on date
     *
     * @return number
     */
    public function getCustomerCount($startDate, $endDate)
    {
        return $this
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get()
            ->count();
    }
}
