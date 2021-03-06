<?php

namespace bvanleeuwen1995\checkColumn;

use yii\grid\DataColumn;

class CheckColumn extends DataColumn
{
    /**
     * @inherit doc
     */
    public $format = 'raw';

    /**
     * The content of the success button
     * @var string
     */
    public $successContent = "<i class=\"fa fa-check\" aria-hidden=\"true\"></i>";

    /**
     * The classes of the success button
     * @var string
     */
    public $successClass = "btn btn-xs btn-success";

    /**
     * The content of the danger button
     * @var string
     */
    public $dangerContent = "<i class=\"fa fa-times\" aria-hidden=\"true\"></i>";

    /**
     * The classes of the danger button
     * @var string
     */
    public $dangerClass = "btn btn-xs btn-danger";

    /**
     * The value we expect when the attribute has a success value
     * @var mixed
     */
    public $successValue = 1;

    /**
     * The value we expect when the attribute has a danger value
     * @var mixed
     */
    public $dangerValue = 0;

    /**
     * The text the success label has
     * @var string
     */
    public $successLabel = 'Active';

    /**
     * The text the danger label has
     * @var string
     */
    public $dangerLabel = 'Inactive';

    /**
     * The prompt label
     * @var string
     */
    public $promptLabel = 'Choose status';

    /**
     * @inheritdoc
     */
    public function init()
    {
        // Set the filter options based on the info we have
        $this->filter = [
            $this->successValue => $this->successLabel,
            $this->dangerValue => $this->dangerLabel,
        ];

        $this->filterInputOptions = [
            'prompt' => $this->promptLabel,
            'class' => 'form-control',
            'id' => null
        ];

        // Get the view
        $view = $this->grid->getView();

        ActiveCheckColumnAsset::register($view);

        return parent::init(); // TODO: Change the autogenerated stub
    }

    /**
     * Render the cell content with the checkboxes
     *
     * @param mixed $model
     * @param mixed $key
     * @param int $index
     * @return string
     */
    public function renderDataCellContent($model, $key, $index)
    {
        // Get the attribute for this cell
        $sAttribute = $this->attribute;

        // Check if we have the positive value
        if ($model->$sAttribute == $this->successValue) {
            return '<div class="'.$this->successClass.'">'.$this->successContent.'</div>';
        } else {
            return '<div class="'.$this->dangerClass.'">'.$this->dangerContent.'</div>';
        }
    }
}